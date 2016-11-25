<?php

declare(strict_types=1);

namespace Signature\Exception;

use RuntimeException;

final class SignatureException extends RuntimeException implements ExceptionInterface
{
    public static function fromInvalidSignature(): self
    {
        return new self('Invalid Signature');
    }

    public static function fromSignatureDoesNotMatch(): self
    {
        return new self('Signature does not match');
    }
}
