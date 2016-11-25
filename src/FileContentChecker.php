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

        // @todo extract this logic for get rid of signature
        $codeWithoutSignature = array_reduce(
            explode(PHP_EOL, $phpCode),
            function (?string $carry, ?string $currentLine): string {

                // if current line is the signature line, we just ignore it
                if (preg_match('{Roave/Signature: (\w)}', $currentLine)) {
                    return $carry;
                }

                if (null === $carry) {
                    return $currentLine;
                }

                if (null !== $currentLine) {
                    return $carry . PHP_EOL . $currentLine;
                }

                return $carry;
            }
        );

        return $this->encoder->verify($codeWithoutSignature, $matches[1]);
    }
}
