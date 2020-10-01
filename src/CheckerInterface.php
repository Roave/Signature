<?php

declare(strict_types=1);

namespace Roave\Signature;

interface CheckerInterface
{
    public function check(string $phpCode): bool;
}
