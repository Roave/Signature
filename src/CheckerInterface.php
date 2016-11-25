<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;
use Roave\Signature\Hasher\HasherInterface;

interface CheckerInterface
{
    public function __construct(EncoderInterface $encoder, HasherInterface $hasher);

    /**
     * @param string $phpCode
     *
     * @return bool
     */
    public function check(string $phpCode);
}
