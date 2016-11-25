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

    public function sign(string $phpCode): string
    {
        return 'Roave/Signature: ' . $this->encoder->encode([$phpCode]);
    }
}
