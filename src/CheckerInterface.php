<?php

declare(strict_types=1);

namespace Signature;

use ReflectionClass;
use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;

interface CheckerInterface
{
    public function __construct(EncoderInterface $encoder, HasherInterface $hasher);

    /**
     * @param ReflectionClass $class
     * @param array           $parameters
     *
     * @throws \Signature\Exception\InvalidSignatureException
     *
     * @return void
     */
    public function check(ReflectionClass $class, array $parameters);
}
