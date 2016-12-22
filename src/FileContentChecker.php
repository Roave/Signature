<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;
use Roave\Signature\Hasher\HasherInterface;

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
     */
    public function check(string $phpCode)
    {
        if (! preg_match('{Roave/Signature:\s+([a-zA-Z0-9\/=]+)}', $phpCode, $matches)) {
            return false;
        }

        return $this->encoder->verify($this->stripCodeSignature($phpCode), $matches[1]);
    }

    /**
     * @param string $phpCode
     *
     * @return string
     */
    private function stripCodeSignature(string $phpCode)
    {
        return preg_replace('{[\/\*\s]+Roave/Signature:\s+([a-zA-Z0-9\/\*\/ =]+)}', '', $phpCode);
    }
}
