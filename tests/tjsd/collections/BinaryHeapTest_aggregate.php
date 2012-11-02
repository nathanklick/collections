<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

abstract class BinaryHeapTest_aggregate extends \PHPUnit_Framework_TestCase {
    protected $object;
    protected $element1;
    protected $element2;
    protected $element3;
    protected $element4;
    
    protected function setUp() {
	$this->object = $this->createTestObject();
	
	$this->element1 = $this->getMock('\tjsd\collections\types\Numeric', array('getNumericValue'));
	$this->element1->expects($this->any())->method('getNumericValue')->will($this->returnValue(1));
	
	$this->element2 = $this->getMock('\tjsd\collections\types\Numeric', array('getNumericValue'));
	$this->element2->expects($this->any())->method('getNumericValue')->will($this->returnValue(2));
	
	$this->element3 = $this->getMock('\tjsd\collections\types\Numeric', array('getNumericValue'));
	$this->element3->expects($this->any())->method('getNumericValue')->will($this->returnValue(3));
	
	$this->element4 = $this->getMock('\tjsd\collections\types\Numeric', array('getNumericValue'));
	$this->element4->expects($this->any())->method('getNumericValue')->will($this->returnValue(4));
    }
    
    protected abstract function createTestObject();

    public function testElementPushedToEmptyHeapIsThanPolled() {
	$this->object->push($this->element1);
	$this->assertSame($this->element1, $this->object->poll());
    }
    
    public function testElementIsRemovedAfterPoll() {
	$this->object->push($this->element1);
	$this->assertEquals(1, $this->object->count());
	$this->object->poll();
	$this->assertEquals(0, $this->object->count());
    }
    
    public function testElementIsNotRemovedAfterTop() {
	$this->object->push($this->element1);
	$this->assertEquals(1, $this->object->count());
	$this->object->top();
	$this->assertEquals(1, $this->object->count());
    }
    
    public function testElementPushedToEmptyHeapIsThanRetrieved() {
	$this->object->push($this->element1);
	$this->assertSame($this->element1, $this->object->poll());
    }

    public function testPollOnEmptyHeapThrowsException() {
	$this->object->clear();
	$this->setExpectedException(
	    'tjsd\collections\exceptions\EmptyCollectionException', 'Cannot retrieve element. Heap is empty.'
	);
	$this->object->poll();
    }
    
    public function testTopOnFromEmptyHeapThrowsException() {
	$this->object->clear();
	$this->setExpectedException(
	    'tjsd\collections\exceptions\EmptyCollectionException', 'Cannot retrieve element. Heap is empty.'
	);
	$this->object->top();
    }
    
    public function testCountReturnsNumberOfElements() {
	$this->object->push($this->element1);
	$this->assertSame(1, $this->object->count());
	
	$this->object->push($this->element2);
	$this->assertSame(2, $this->object->count());
    }
    
    public function testGetIteratorReturnsIterator() {
	 $this->assertInstanceOf('\tjsd\collections\Iterator', $this->object->getIterator());
    }
    
    public function testClearRemovesAllElements() {
	$this->object->push($this->element1);
	$this->object->clear();
	$this->assertTrue($this->object->isEmpty());
    }
}