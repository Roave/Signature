<?php

declare(strict_types=1);

namespace Signature;

use Zend\Code\Generator\ClassGenerator;

interface ClassSignerInterface
{
    public function sign(ClassGenerator $classGenerator, array $params) : ClassGenerator;

    /* TODO: move to  a encoder class */
    public function generateKey(array $key) : string;

    /* TODO: move to  a encoder class */
    public function encode(array $key) : string;
}
