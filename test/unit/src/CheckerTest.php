<?php

declare(strict_types=1);

namespace SignatureTest;

use Signature\Checker;
use Signature\Encoder\Base64Encoder;
use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;
use Signature\Hasher\Md5Hasher;
use SignatureTestFixture\ClassWithValidSignerProperty;

/**
 * @covers \Signature\Checker
 */
final class CheckerTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckInvalidSignature()
    {
        $checker = new Checker(new Base64Encoder(), new Md5Hasher());

        $this->expectException(\RuntimeException::class);

        $checker->check(new \ReflectionClass(\stdClass::class), []);
    }

    public function testCheck()
    {
        $encoder = $this->createMock(EncoderInterface::class);
        $hasher  = $this->createMock(HasherInterface::class);

        $encoder->expects(self::exactly(1))->method('encode')->with([])->willReturn('YTowOnt9');
        $hasher->expects(self::exactly(1))->method('hash')->with([])->willReturn('40cd750bba9870f18aada2478b24840a');

        $checker = new Checker($encoder, $hasher);

        $checker->check(new \ReflectionClass(ClassWithValidSignerProperty::class), []);
    }
}
