<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

class NumericContainerTest extends \PHPUnit_Framework_TestCase {
    
    public function test__construct()
    {
	$object = new NumericContainer(0);
	$this->assertInstanceOf('\tjsd\collections\types\NumericContainer', $object);
    }
    
    public function testGetNumericValueReturnsInitialValue() {
	$object = new NumericContainer(-5);
	$this->assertSame(-5, $object->getNumericValue());
    }
}
