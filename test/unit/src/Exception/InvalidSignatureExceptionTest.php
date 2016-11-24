<?php

declare(strict_types=1);

namespace SignatureTest\Exception;

use Signature\Exception\InvalidSignatureException;

/**
 * @covers \Signature\Exception\InvalidSignatureException
 */
final class InvalidSignatureExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidSignatureException()
    {
        $exception = new InvalidSignatureException();

        self::assertInstanceOf(InvalidSignatureException::class, $exception);
        self::assertSame('Invalid Signature', $exception->getMessage());

        $this->expectException(InvalidSignatureException::class);

        throw $exception;
    }
}
