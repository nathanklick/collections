<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

class ValueNumericContainerTest extends \PHPUnit_Framework_TestCase {

    public function test__construct() {
	$object = new ValueNumericContainer(0, new \stdClass());
	$this->assertInstanceOf('\tjsd\collections\types\ValueNumericContainer', $object);
    }
    
    public function testGetNumericValueReturnsInitialNumericValue() {
	$object = new ValueNumericContainer(-5, new \stdClass());
	$this->assertSame(-5, $object->getNumericValue());
    }
    
    public function testGetValueReturnsInitialValue() {
	$value = new \stdClass();
	$object = new ValueNumericContainer(-5, $value);
	$this->assertSame($value, $object->getValue());
    }
}
