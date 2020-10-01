<?php

declare(strict_types=1);

namespace Roave\SignatureTest\Encoder;

use PHPUnit\Framework\TestCase;
use Roave\Signature\Encoder\Base64Encoder;

use function base64_encode;
use function uniqid;

/**
 * @covers \Roave\Signature\Encoder\Base64Encoder
 */
final class Base64EncoderTest extends TestCase
{
    public function testEncode(): void
    {
        $encoder = new Base64Encoder();

        self::assertSame('IA==', $encoder->encode(' '));
        self::assertSame('PD9waHA=', $encoder->encode('<?php'));
    }

    public function testVerify(): void
    {
        $value = uniqid('values', true);
        self::assertTrue((new Base64Encoder())->verify($value, base64_encode($value)));
    }
}
