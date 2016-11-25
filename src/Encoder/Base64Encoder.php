<?php

declare(strict_types=1);

namespace Roave\Signature\Encoder;

final class Base64Encoder implements EncoderInterface
{
    /**
     * {@inheritDoc}
     */
    public function encode(string $parameters): string
    {
        return base64_encode($parameters);
    }
}
