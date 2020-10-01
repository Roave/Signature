<?php

declare(strict_types=1);

namespace Roave\Signature\Encoder;

use function base64_encode;
use function hash_equals;

final class Base64Encoder implements EncoderInterface
{
    public function encode(string $codeWithoutSignature): string
    {
        return base64_encode($codeWithoutSignature);
    }

    public function verify(string $codeWithoutSignature, string $signature): bool
    {
        return hash_equals($this->encode($codeWithoutSignature), $signature);
    }
}
