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
    
        public function testCompareToContainerWithSameValueReturnsZero() {
	$object = new ValueNumericContainer(2, 'foo');
	$compared = new ValueNumericContainer(2, 'bar');
	$this->assertSame(0, $object->compareTo($compared));
    }
    
    public function testCompareToContainerWithSmallerValueReturnsOne() {
	$object = new ValueNumericContainer(2, 'foo');
	$compared = new ValueNumericContainer(1, 'bar');
	$this->assertSame(1, $object->compareTo($compared));
    }
    
    public function testCompareToContainerWithBiggerValueReturnsMinusOne() {
	$object = new ValueNumericContainer(2, 'foo');
	$compared = new ValueNumericContainer(3, 'bar');
	$this->assertSame(-1, $object->compareTo($compared));
    }
    
    public function testComparingToIncompatibleTypeThrowsException() {
	$object = new ValueNumericContainer(0, 'foo');
	$compared = $this->getMock('\tjsd\collections\types\Comparable');
	
	$this->setExpectedException('\InvalidArgumentException');
	$object->compareTo($compared);
    }
}