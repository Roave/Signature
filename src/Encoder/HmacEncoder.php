<?php

declare(strict_types=1);

namespace Roave\Signature\Encoder;

use function hash_equals;
use function hash_hmac;

final class HmacEncoder implements EncoderInterface
{
    private string $hmacKey;

    public function __construct(string $hmacKey)
    {
        $this->hmacKey = $hmacKey;
    }

    public function encode(string $codeWithoutSignature): string
    {
        return hash_hmac('sha256', $codeWithoutSignature, $this->hmacKey);
    }

    public function verify(string $codeWithoutSignature, string $signature): bool
    {
        return hash_equals($this->encode($codeWithoutSignature), $signature);
    }
}
