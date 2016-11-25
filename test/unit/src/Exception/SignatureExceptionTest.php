<?php

declare(strict_types=1);

namespace SignatureTest\Exception;

use Signature\Exception\SignatureException;

/**
 * @covers \Signature\Exception\SignatureException
 */
final class SignatureExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testFromInvalidSignature()
    {
        $exception = SignatureException::fromInvalidSignature();

        self::assertInstanceOf(SignatureException::class, $exception);
        self::assertSame('Invalid Signature', $exception->getMessage());

        $this->expectException(SignatureException::class);

        throw $exception;
    }

    public function testFromSignatureDoesNotMatch()
    {
        $exception = SignatureException::fromSignatureDoesNotMatch();

        self::assertInstanceOf(SignatureException::class, $exception);
        self::assertSame('Signature does not match', $exception->getMessage());

        $this->expectException(SignatureException::class);

        throw $exception;
    }
}
