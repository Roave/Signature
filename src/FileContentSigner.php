<?php

declare(strict_types=1);

namespace Signature;

use Signature\Encoder\EncoderInterface;
use Signature\Hasher\HasherInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\PropertyGenerator;

final class FileContentSigner implements SignerInterface
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

    public function sign(ClassGenerator $classGenerator, array $parameters): ClassGenerator
    {
        $classGenerator->addPropertyFromGenerator(new PropertyGenerator(
            'fileContentSignature' . $this->hasher->hash([$classGenerator->getName()]),
            $this->encoder->encode([$classGenerator->getSourceContent()]),
            PropertyGenerator::FLAG_STATIC | PropertyGenerator::FLAG_PRIVATE
        ));

        return $classGenerator;
    }
}
