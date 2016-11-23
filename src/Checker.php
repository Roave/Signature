<?php

declare(strict_types=1);

namespace Signature;

use ReflectionClass;
use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;

final class Checker implements CheckerInterface
{
    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var HasherInterface
     */
    private $hasher;

    /**
     * {@inheritDoc}
     */
    public function __construct(EncoderInterface $encoder, HasherInterface $hasher)
    {
        $this->encoder = $encoder;
        $this->hasher  = $hasher;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \RuntimeException
     */
    public function check(ReflectionClass $class, array $parameters)
    {
        $propertyName      = 'verify' . $this->hasher->hash($parameters);
        $signature         = $this->encoder->encode($parameters);
        $defaultProperties = $class->getDefaultProperties();

        if (! isset($defaultProperties[$propertyName])) {
            throw new \RuntimeException('Invalid Signature');
        }

        if ($defaultProperties[$propertyName] !== $signature) {
            throw new \RuntimeException('Signature doesn\'t match');
        }
    }
}
