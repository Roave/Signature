<?php

declare(strict_types=1);

namespace Roave\SignatureTest\Encoder;

use PHPUnit\Framework\TestCase;
use Roave\Signature\Encoder\HmacEncoder;

use function hash_hmac;
use function random_bytes;
use function uniqid;

/**
 * @covers \Roave\Signature\Encoder\HmacEncoder
 */
final class HmacEncoderTest extends TestCase
{
    public function testEncode(): void
    {
        $hmacKey = random_bytes(64);
        $value   = uniqid('values', true);
        self::assertSame(
            hash_hmac('sha256', $value, $hmacKey),
            (new HmacEncoder($hmacKey))->encode($value)
        );
    }

    public function testVerify(): void
    {
        $hmacKey = random_bytes(64);
        $value   = uniqid('values', true);
        self::assertTrue((new HmacEncoder($hmacKey))->verify($value, hash_hmac('sha256', $value, $hmacKey)));
    }
}
