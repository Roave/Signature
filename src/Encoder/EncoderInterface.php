<?php

declare(strict_types=1);

namespace Roave\Signature\Encoder;

interface EncoderInterface
{
    public function encode(array $parameters): string;
}
