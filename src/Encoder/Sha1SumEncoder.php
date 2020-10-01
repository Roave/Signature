<?php

declare(strict_types=1);

namespace Roave\Signature\Encoder;

use function hash_equals;
use function sha1;

final class Sha1SumEncoder implements EncoderInterface
{
    public function encode(string $codeWithoutSignature): string
    {
        return sha1($codeWithoutSignature);
    }

    public function verify(string $codeWithoutSignature, string $signature): bool
    {
        return hash_equals($this->encode($codeWithoutSignature), $signature);
    }
}
