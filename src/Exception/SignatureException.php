<?php

declare(strict_types=1);

namespace Signature\Exception;

use RuntimeException;

final class SignatureException extends RuntimeException implements ExceptionInterface
{
    public static function fromInvalidSignature()
    {
        return new self('Invalid Signature');
    }
}
