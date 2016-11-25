<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;
use Roave\Signature\Hasher\HasherInterface;

interface SignerInterface
{
    public function __construct(EncoderInterface $encoder, HasherInterface $hasher);

    public function sign(string $phpCode) : string;
}
