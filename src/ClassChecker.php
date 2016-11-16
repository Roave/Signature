<?php

declare(strict_types=1);

namespace Signature;

use BetterReflection\Reflection\ReflectionClass;

class ClassChecker
{
    /**
     * @var ClassSignerInterface
     */
    private $signer;

    /**
     * @param ClassSignerInterface $signatureGenerator
     */
    public function __construct(ClassSignerInterface $signatureGenerator)
    {
        $this->signer = $signatureGenerator;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \RuntimeException
     */
    public function checkSignature(ReflectionClass $class, array $parameters)
    {
        $propertyName      = 'verify' . $this->signer->generateKey($parameters);
        $signature         = $this->signer->encode($parameters);
        $defaultProperties = $class->getDefaultProperties();

        if (! isset($defaultProperties[$propertyName])) {
            throw new \RuntimeException('Invalid Signature');
        }

        if ($defaultProperties[$propertyName] !== $signature) {
            throw new \RuntimeException('Signature doesn\'t match');
        }
    }
}
