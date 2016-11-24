<?php

declare(strict_types=1);

namespace SignatureTest;

use PHPUnit_Framework_TestCase;
use Signature\Encoder\Base64Encoder;
use Signature\FileContentSigner;
use Signature\Hasher\Md5Hasher;
use SignatureTestFixture\UserClass;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\PropertyGenerator;

/**
 * @covers \Signature\FileContentSigner
 */
final class FileContentSignerTest extends PHPUnit_Framework_TestCase
{
    public function testSign()
    {
        $signer         = new FileContentSigner(new Base64Encoder(), new Md5Hasher());
        $classGenerator = $signer->sign(new ClassGenerator(UserClass::class), ['foo']);
        $properties     = $classGenerator->getProperties();

        self::assertCount(1, $properties);
        self::assertArrayHasKey('fileContentSignatureb888fe9c927e4c9abaa4b1f54a27fbca', $properties);
        self::assertInstanceOf(PropertyGenerator::class, $properties['fileContentSignatureb888fe9c927e4c9abaa4b1f54a27fbca']);
    }
}
