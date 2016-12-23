<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;

interface CheckerInterface
{
    public function __construct(EncoderInterface $encoder);

    /**
     * @param string $phpCode
     *
     * @return bool
     */
    public function check(string $phpCode): bool;
}
