<?php

declare(strict_types=1);

namespace SignatureTest;

use PHPUnit_Framework_TestCase;
use Signature\Encoder\Base64Encoder;
use Signature\Encoder\EncoderInterface;
use Signature\Exception\SignatureException;
use Signature\Exception\SignatureDoesNotMatchException;
use Signature\FileContentChecker;
use Signature\Hasher\HasherInterface;
use Signature\Hasher\Md5Hasher;
use SignatureTestFixture\UserClassSignedByFileContent;

/**
 * @covers \Signature\FileContentChecker
 */
final class FileContentCheckerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EncoderInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $encoder;

    /**
     * @var HasherInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $hasher;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->encoder = $this->createMock(EncoderInterface::class);
        $this->hasher  = $this->createMock(HasherInterface::class);
    }

    public function testShouldCheckClassFileContent()
    {
        $classFilePath = __DIR__ . '/../../fixture/UserClassSignedByFileContent.php';

        self::assertFileExists($classFilePath);

        $checker = new FileContentChecker(new Base64Encoder(), new Md5Hasher());

        $checker->check(new \ReflectionClass(UserClassSignedByFileContent::class), []);
    }

    public function testShouldThrowExceptionInCaseOfInvalidSignature()
    {
        $classFilePath = __DIR__ . '/../../fixture/UserClassSignedByFileContent.php';

        self::assertFileExists($classFilePath);

        $this->encoder->expects(self::once())->method('encode')->with([
            str_replace(
                '/** Roave/Signature: YToxOntpOjA7czoxNDE6Ijw/cGhwCgpuYW1lc3BhY2UgU2lnbmF0dXJlVGVzdEZpeHR1cmU7CgpjbGFzcyBVc2VyQ2xhc3NTaWduZWRCeUZpbGVDb250ZW50CnsKICAgIHB1YmxpYyAkbmFtZTsKCiAgICBwcm90ZWN0ZWQgJHN1cm5hbWU7CgogICAgcHJpdmF0ZSAkYWdlOwp9CiI7fQ== */' . "\n",
                '',
                file_get_contents($classFilePath)
            )
        ]);

        /* @var $reflection \ReflectionClass|\PHPUnit_Framework_MockObject_MockObject */
        $reflection = $this->createMock(\ReflectionClass::class);

        $reflection->expects(self::exactly(3))->method('getFileName')->willReturn($classFilePath);

        $checker = new FileContentChecker($this->encoder, $this->hasher);

        $this->expectException(SignatureException::class);
        $this->expectExceptionMessage('Signature does not match');

        $checker->check($reflection, []);
    }

    public function testShouldThrowExceptionInCaseOfSignatureDoesNotMatch()
    {
        $classFilePath = __DIR__ . '/../../fixture/UserClass.php';

        self::assertFileExists($classFilePath);

        /* @var $reflection \ReflectionClass|\PHPUnit_Framework_MockObject_MockObject */
        $reflection = $this->createMock(\ReflectionClass::class);

        $reflection->expects(self::exactly(2))->method('getFileName')->willReturn($classFilePath);

        $checker = new FileContentChecker($this->encoder, $this->hasher);

        $this->expectException(SignatureException::class);

        $checker->check($reflection, []);
    }

    public function testShouldThrowExceptionInCaseOfFileNotLocated()
    {
        $checker = new FileContentChecker($this->encoder, $this->hasher);

        $this->expectException(\RuntimeException::class);

        $checker->check(new \ReflectionClass(\stdClass::class), []);
    }
}