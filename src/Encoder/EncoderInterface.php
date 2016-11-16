<?php

declare(strict_types=1);

namespace Signature\Encoder;

interface EncoderInterface
{
    public function encode(array $parameters): string;
}
