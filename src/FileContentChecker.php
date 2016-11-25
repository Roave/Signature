<?php

declare(strict_types=1);

namespace Signature;

use ReflectionClass;
use Signature\Encoder\EncoderInterface;
use Signature\Exception\SignatureException;
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
        // @todo missing check/exception if file is readable
        if (! $class->getFileName()) {
            // @todo specific exception
            throw new \RuntimeException('File could not be located');
        }

        // @todo refactor the extraction of the signature
        $fileContent = file_get_contents($class->getFileName());

        if (! preg_match('{Roave/Signature: ([a-zA-Z0-9\/=]+)}', $fileContent, $matches)) {
            throw SignatureException::fromInvalidSignature();
        }

        // @todo extract this logic for get rid of signature
        $codeWithoutSignature = implode(
            array_filter(
                array_map(
                    function (string $line): ?string {
                        if (! preg_match('{Roave/Signature: (\w)}', $line, $matches)) {
                            return $line;
                        }

                        return null;
                    },
                    file($class->getFileName())
                )
            )
        );

        $signature = $this->encoder->encode([$codeWithoutSignature]);

        if ($matches[1] !== $signature) {
            throw SignatureException::fromSignatureDoesNotMatch();
        }
    }
}
