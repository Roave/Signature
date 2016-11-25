<?php

declare(strict_types=1);

namespace Signature;

use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;

interface SignerInterface
{
    public function __construct(EncoderInterface $encoder, HasherInterface $hasher);

    public function sign(string $phpCode) : string;
}
