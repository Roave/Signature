<?php

declare(strict_types=1);

namespace Signature;

use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\PropertyGenerator;

class Signer implements SignerInterface
{
    /**
     * @var HasherInterface
     */
    private $hasher;

    /**
     * @var EncoderInterface
     */
    private $encoder;

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
     * @throws \Zend\Code\Exception\InvalidArgumentException
     */
    public function sign(ClassGenerator $classGenerator, array $parameters) : ClassGenerator
    {
        $classGenerator->addPropertyFromGenerator(new PropertyGenerator(
            'verify' . $this->hasher->hash($parameters),
            $this->encoder->encode($parameters),
            PropertyGenerator::FLAG_STATIC | PropertyGenerator::FLAG_PRIVATE
        ));

        return $classGenerator;
    }
}
