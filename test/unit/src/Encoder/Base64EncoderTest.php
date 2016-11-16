<?php

declare(strict_types=1);

namespace SignatureTest\Encoder;

use Signature\Encoder\Base64Encoder;

/**
 * Tests for {@see Signature\Encoder\Base64Encoder}.
 *
 * @group   Unitary
 * @author  Jefersson Nathan <malukenho@phpse.net>
 * @license MIT
 *
 * @covers \Signature\Encoder\Base64Encoder
 */
final class Base64EncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testEncode()
    {
        $encoder = new Base64Encoder();

        self::assertSame('YTowOnt9', $encoder->encode([]));
        self::assertSame('YToxOntpOjA7Tjt9', $encoder->encode([null]));
        self::assertSame('YTozOntpOjA7aToxO2k6MTtpOjI7aToyO2k6Mzt9', $encoder->encode([1, 2, 3]));
        self::assertSame(
            'YToxOntzOjY6InBhcmFtcyI7YToyOntzOjM6Im9uZSI7YTowOnt9czozOiJ0d28iO2k6MTIzO319',
            $encoder->encode(['params' => ['one' => [], 'two' => 123]])
        );
    }
}
