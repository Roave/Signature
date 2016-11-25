<?php

declare(strict_types=1);

namespace Signature\Hasher;

interface HasherInterface
{
    public function hash(array $parameters): string;
}
