<?php

declare(strict_types=1);

namespace Signature\Exception;

use DomainException;

final class InvalidSignatureException extends DomainException
{
    /**
     * {@inheritDoc}
     */
    protected $message = 'Invalid Signature';
}
