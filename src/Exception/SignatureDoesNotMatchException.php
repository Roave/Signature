<?php

declare(strict_types=1);

namespace Signature\Exception;

use RuntimeException;

final class SignatureDoesNotMatchException extends RuntimeException
{
    /**
     * {@inheritDoc}
     */
    protected $message = 'Signature does not match';
}
