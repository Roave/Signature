<?php

declare(strict_types=1);

namespace Signature\Exception;

final class SignatureException extends RuntimeException
{
    public static function fromInvalidSignature()
    {
        return new self('Invalid Signature');
    }
}
