<?php

declare(strict_types=1);

namespace Signature\Hasher;

/**
 * @author Jefersson Nathan <malukenho@phpse.net>
 * @license MIT
 */
final class Md5Hasher implements HasherInterface
{
    /**
     * {@inheritDoc}
     */
    public function hash(array $parameters): string
    {
        return md5(serialize($parameters));
    }
}
