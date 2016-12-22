<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;

interface SignerInterface
{
    public function __construct(EncoderInterface $encoder);

    public function sign(string $phpCode) : string;
}
