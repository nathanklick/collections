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
    
    public function testCompareToContainerWithSameValueReturnsZero() {
	$object = new NumericContainer(2);
	$compared = new NumericContainer(2);
	$this->assertSame(0, $object->compareTo($compared));
    }
    
    public function testCompareToContainerWithSmallerValueReturnsOne() {
	$object = new NumericContainer(2);
	$compared = new NumericContainer(1);
	$this->assertSame(1, $object->compareTo($compared));
    }
    
    public function testCompareToContainerWithBiggerValueReturnsMinusOne() {
	$object = new NumericContainer(2);
	$compared = new NumericContainer(3);
	$this->assertSame(-1, $object->compareTo($compared));
    }
    
    public function testComparingToIncompatibleTypeThrowsException() {
	$object = new NumericContainer(0);
	$compared = $this->getMock('\tjsd\collections\types\Comparable');
	
	$this->setExpectedException('\InvalidArgumentException');
	$object->compareTo($compared);
    }
}