<?php

declare(strict_types=1);

namespace Roave\SignatureTest\Encoder;

use Roave\Signature\Encoder\ShaSumEncoder;

/**
 * @covers \Roave\Signature\Encoder\ShaSumEncoder
 */
final class ShaSumEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testEncode()
    {
        $value = uniqid('values', true);
        self::assertSame(sha1($value), (new ShaSumEncoder())->encode($value));
    }

    public function testVerify()
    {
        $value = uniqid('values', true);
        self::assertTrue((new ShaSumEncoder())->verify($value, sha1($value)));
    }
}
