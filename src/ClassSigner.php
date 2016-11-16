<?php

declare(strict_types=1);

namespace Signature;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\PropertyGenerator;

class ClassSigner implements ClassSignerInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws \Zend\Code\Exception\InvalidArgumentException
     */
    public function sign(ClassGenerator $classGenerator, array $parameters) : ClassGenerator
    {
        $classGenerator->addPropertyFromGenerator(new PropertyGenerator(
            'verify' . $this->generateKey($parameters),
            $this->encode($parameters),
            PropertyGenerator::FLAG_STATIC | PropertyGenerator::FLAG_PRIVATE
        ));

        return $classGenerator;
    }

    /**
     * {@inheritDoc}
     */
    public function encode(array $parameters) : string
    {
        return base64_encode(serialize($parameters));
    }

    /**
     * {@inheritDoc}
     */
    public function generateKey(array $parameters) : string
    {
        return md5(serialize($parameters));
    }
}
