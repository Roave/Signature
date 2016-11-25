<?php

declare(strict_types=1);

namespace Roave\SignatureTest;

use PHPUnit_Framework_TestCase;
use Roave\Signature\Encoder\Base64Encoder;
use Roave\Signature\FileContentSigner;
use Roave\Signature\Hasher\Md5Hasher;

/**
 * @covers \Roave\Signature\FileContentSigner
 */
final class FileContentSignerTest extends PHPUnit_Framework_TestCase
{
    public function testSign()
    {
        $signer = new FileContentSigner(new Base64Encoder(), new Md5Hasher());

        self::assertSame('Roave/Signature: YToxOntpOjA7czo1OiI8P3BocCI7fQ==', $signer->sign('<?php'));
        self::assertSame('Roave/Signature: YToxOntpOjA7czo2OiI8P3BocAoiO30=', $signer->sign('<?php' . "\n"));
        self::assertSame('Roave/Signature: YToxOntpOjA7czo2OiI8aHRtbD4iO30=', $signer->sign('<html>'));
        self::assertSame('Roave/Signature: YToxOntpOjA7czoxMDoicGxhaW4gdGV4dCI7fQ==', $signer->sign('plain text'));
    }
}
