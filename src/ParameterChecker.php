<?php

declare(strict_types=1);

namespace Signature;

use ReflectionClass;
use Signature\Encoder\EncoderInterface;
use Signature\Exception\SignatureException;
use Signature\Exception\SignatureDoesNotMatchException;
use Signature\Hasher\HasherInterface;

final class ParameterChecker implements CheckerInterface
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
     */
    public function check(ReflectionClass $class, array $parameters)
    {
        $propertyName      = 'verify' . $this->hasher->hash($parameters);
        $signature         = $this->encoder->encode($parameters);
        $defaultProperties = $class->getDefaultProperties();

        if (! isset($defaultProperties[$propertyName])) {
            throw SignatureException::fromInvalidSignature();
        }

        if ($defaultProperties[$propertyName] !== $signature) {
            throw SignatureException::fromSignatureDoesNotMatch();
        }
    }
}
