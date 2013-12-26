<?php

namespace Xaben\FacebookBundle\Tests\Twig;

use Xaben\FacebookBundle\Twig\FacebookSPExtension;

class FacebookSPExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testEqualIntegers(){
        $this->assertEquals(1,10, 'integers arent equal');
    }
}