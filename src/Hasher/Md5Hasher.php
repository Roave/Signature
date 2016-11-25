<?php

declare(strict_types=1);

namespace Roave\Signature\Hasher;

final class Md5Hasher implements HasherInterface
{
    /**
     * {@inheritDoc}
     */
    public function hash(string $parameters): string
    {
        return md5($parameters);
    }
}
