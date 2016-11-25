<?php

declare(strict_types=1);

namespace Roave\Signature\Hasher;

interface HasherInterface
{
    public function hash(string $parameters): string;
}
