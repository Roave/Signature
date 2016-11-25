<?php

declare(strict_types=1);

namespace Roave\SignatureTest\Hasher;

use Roave\Signature\Hasher\Md5Hasher;

/**
 * @covers \Roave\Signature\Hasher\Md5Hasher
 */
final class Md5HasherTest extends \PHPUnit_Framework_TestCase
{
    public function testHash()
    {
        $hasher = new Md5Hasher();

        self::assertSame('7215ee9c7d9dc229d2921a40e899ec5f', $hasher->hash(' '));
        self::assertSame('5570a6d194c76efe98e2df6cd99a6283', $hasher->hash('hash it them'));
    }
}
