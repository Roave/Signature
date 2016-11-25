<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;
use Roave\Signature\Hasher\HasherInterface;

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
        return 'Roave/Signature: ' . $this->encoder->encode($phpCode);
    }
}
