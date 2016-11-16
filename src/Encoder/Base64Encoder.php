<?php

declare(strict_types=1);

namespace Signature\Encoder;

/**
 * @author Jefersson Nathan <malukenho@phpse.net>
 * @license MIT
 */
final class Base64Encoder implements EncoderInterface
{
    /**
     * {@inheritDoc}
     */
    public function encode(array $parameters): string
    {
        return base64_encode(serialize($parameters));
    }
}
