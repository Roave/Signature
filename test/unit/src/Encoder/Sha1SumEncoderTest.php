<?php

declare(strict_types=1);

namespace Roave\SignatureTest\Encoder;

use PHPUnit\Framework\TestCase;
use Roave\Signature\Encoder\Sha1SumEncoder;

use function sha1;
use function uniqid;

/** @covers \Roave\Signature\Encoder\Sha1SumEncoder */
final class Sha1SumEncoderTest extends TestCase
{
    public function testEncode(): void
    {
        $value = uniqid('values', true);
        self::assertSame(sha1($value), (new Sha1SumEncoder())->encode($value));
    }

    public function testVerify(): void
    {
        $value = uniqid('values', true);
        self::assertTrue((new Sha1SumEncoder())->verify($value, sha1($value)));
    }
}
