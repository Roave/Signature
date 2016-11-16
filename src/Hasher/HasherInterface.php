<?php

declare(strict_types=1);

namespace Signature\Hasher;

/**
 * @author Jefersson Nathan <malukenho@phpse.net>
 * @license MIT
 */
interface HasherInterface
{
    public function hash(array $parameters): string;
}
