<?php

declare(strict_types=1);

namespace SignatureTest;

use Signature\ClassSigner;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\PropertyGenerator;

class ClassSignerTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldSignAClass()
    {
        $signer         = new ClassSigner();
        $classGenerator = $signer->sign(new ClassGenerator('DummyClass'), ['foo']);
        $properties     = $classGenerator->getProperties();

        $this->assertCount(1, $properties);
        $this->assertArrayHasKey('signature4109c93b3462dad44dc7bc4215c9f174', $properties);
        $this->assertInstanceOf(PropertyGenerator::class, $properties['signature4109c93b3462dad44dc7bc4215c9f174']);
    }
}
