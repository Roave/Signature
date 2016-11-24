<?php

declare(strict_types=1);

namespace SignatureTest\Exception;

use Signature\Exception\SignatureDoesNotMatchException;

/**
 * @covers \Signature\Exception\SignatureDoesNotMatchException
 */
final class SignatureDoesNotMatchExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testSignatureDoesNotMatchException()
    {
        $exception = new SignatureDoesNotMatchException();

        self::assertInstanceOf(SignatureDoesNotMatchException::class, $exception);
        self::assertSame('Signature does not match', $exception->getMessage());

        $this->expectException(SignatureDoesNotMatchException::class);

        throw $exception;
    }
}
