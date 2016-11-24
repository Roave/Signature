<?php

declare(strict_types=1);

namespace Signature;

use ReflectionClass;
use Signature\Encoder\EncoderInterface;
use Signature\Exception\InvalidSignatureException;
use Signature\Exception\SignatureDoesNotMatchException;
use Signature\Hasher\HasherInterface;

final class FileContentChecker implements CheckerInterface
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
        $propertyName = 'fileContentSignature' . $this->hasher->hash([$class->getName()]);

        if (! $class->getFileName()) {
            // @todo specific exception
            throw new \RuntimeException('File could not be located');
        }

        // @todo missing check/exception if file is readable

        $signature         = $this->encoder->encode([file_get_contents($class->getFileName())]);
        $defaultProperties = $class->getDefaultProperties();

        if (! isset($defaultProperties[$propertyName])) {
            throw new InvalidSignatureException();
        }

        if ($defaultProperties[$propertyName] !== $signature) {
            throw new SignatureDoesNotMatchException();
        }
    }
}
