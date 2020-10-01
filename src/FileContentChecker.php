<?php

declare(strict_types=1);

namespace Roave\Signature;

use Roave\Signature\Encoder\EncoderInterface;

use function preg_match;
use function preg_replace;

final class FileContentChecker implements CheckerInterface
{
    /** @var EncoderInterface */
    private $encoder;

    /**
     * {@inheritDoc}
     */
    public function __construct(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function check(string $phpCode): bool
    {
        if (! preg_match('{Roave/Signature:\s+([a-zA-Z0-9\/=]+)}', $phpCode, $matches)) {
            return false;
        }

        return $this->encoder->verify($this->stripCodeSignature($phpCode), $matches[1]);
    }

    private function stripCodeSignature(string $phpCode): string
    {
        return preg_replace('{[\/\*\s]+Roave/Signature:\s+([a-zA-Z0-9\/\*\/ =]+)}', '', $phpCode);
    }
}
