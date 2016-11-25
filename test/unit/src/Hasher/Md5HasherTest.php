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

        self::assertSame('40cd750bba9870f18aada2478b24840a', $hasher->hash([]));
        self::assertSame('38017a839aaeb8ff1a658fce9af6edd3', $hasher->hash([null]));
        self::assertSame('262bbc0aa0dc62a93e350f1f7df792b9', $hasher->hash([1, 2, 3]));
        self::assertSame('aa565c66cb423c77379a37dd2d17bb2b', $hasher->hash(['params' => ['one' => [], 'two' => 123]]));
    }
}
