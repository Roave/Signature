<?php

declare(strict_types=1);

namespace Roave\SignatureTest;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Roave\Signature\Encoder\Base64Encoder;
use Roave\Signature\Encoder\EncoderInterface;
use Roave\Signature\FileContentChecker;

use function assert;
use function file_get_contents;
use function is_string;
use function str_replace;

#[CoversClass(FileContentChecker::class)]
final class FileContentCheckerTest extends TestCase
{
    /** @var EncoderInterface&MockObject */
    private $encoder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->encoder = $this->createMock(EncoderInterface::class);
    }

    public function testShouldCheckClassFileContent(): void
    {
        $classFilePath = __DIR__ . '/../../fixture/UserClassSignedByFileContent.php';

        self::assertFileExists($classFilePath);

        $checker = new FileContentChecker(new Base64Encoder());

        $checker->check(self::readFile($classFilePath));
    }

    public function testShouldReturnFalseIfSignatureDoesNotMatch(): void
    {
        $classFilePath = __DIR__ . '/../../fixture/UserClassSignedByFileContent.php';

        self::assertFileExists($classFilePath);

        $expectedSignature = 'YToxOntpOjA7czoxNDE6Ijw/cGhwCgpuYW1lc3BhY2UgU2lnbmF0dXJlVGVzdEZpeHR1cmU7' .
            'CgpjbGFzcyBVc2VyQ2xhc3NTaWduZWRCeUZpbGVDb250ZW50CnsKICAgIHB1YmxpYyAkbmFtZTsKCiAgICBwcm90ZW' .
            'N0ZWQgJHN1cm5hbWU7CgogICAgcHJpdmF0ZSAkYWdlOwp9CiI7fQ==';

        $this->encoder->expects(self::once())->method('verify')->with(
            str_replace(
                '/** Roave/Signature: ' . $expectedSignature . ' */' . "\n",
                '',
                self::readFile($classFilePath),
            ),
            $expectedSignature,
        );

        $checker = new FileContentChecker($this->encoder);

        self::assertFalse($checker->check(self::readFile($classFilePath)));
    }

    public function testShouldReturnFalseIfClassIsNotSigned(): void
    {
        $classFilePath = __DIR__ . '/../../fixture/UserClass.php';

        self::assertFileExists($classFilePath);

        $checker = new FileContentChecker($this->encoder);

        self::assertFalse($checker->check(self::readFile($classFilePath)));
    }

    private static function readFile(string $path): string
    {
        $contents = file_get_contents($path);

        assert(is_string($contents));

        return $contents;
    }
}
