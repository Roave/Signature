<?php

declare(strict_types=1);

namespace Signature;

use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;

interface CheckerInterface
{
    public function __construct(EncoderInterface $encoder, HasherInterface $hasher);

    /**
     * @param string $phpCode
     *
     * @throws \Signature\Exception\SignatureException
     *
     * @return void
     */
    public function check(string $phpCode);
}
