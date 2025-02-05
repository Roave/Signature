<?php

declare(strict_types=1);

namespace Roave\SignatureTest;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Roave\Signature\Encoder\Base64Encoder;
use Roave\Signature\FileContentSigner;

#[CoversClass(FileContentSigner::class)]
final class FileContentSignerTest extends TestCase
{
    /** @return non-empty-list<list{non-empty-string, non-empty-string}> */
    public static function signProvider(): array
    {
        return [
            ['Roave/Signature: PD9waHA=', '<?php'],
            ['Roave/Signature: PD9waHAK', '<?php' . "\n"],
            ['Roave/Signature: PGh0bWw+', '<html>'],
            ['Roave/Signature: cGxhaW4gdGV4dA==', 'plain text'],
        ];
    }

    /** @dataProvider signProvider */
    #[DataProvider('signProvider')]
    public function testSign(string $expected, string $inputString): void
    {
        $signer = new FileContentSigner(new Base64Encoder());

        self::assertSame($expected, $signer->sign($inputString));
    }
}
