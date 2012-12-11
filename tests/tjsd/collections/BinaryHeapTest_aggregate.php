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
    protected $element5;
    protected $element6;
    protected $element7;
    
    protected function setUp() {
	$this->object = $this->createTestObject();
	
	$this->element1 = new types\NumericContainer(1);
	$this->element2 = new types\NumericContainer(2);
	$this->element3 = new types\NumericContainer(3);
	$this->element4 = new types\NumericContainer(4);
	$this->element5 = new types\NumericContainer(5);
	$this->element6 = new types\NumericContainer(6);
	$this->element7 = new types\NumericContainer(7);
    }
    
    protected abstract function createTestObject();

    public function testElementPushedToEmptyHeapIsThanPolled() {
	$this->object->push($this->element1);
	$this->assertSame($this->element1, $this->object->poll());
    }
    
    public function testElementIsRemovedAfterPoll() {
	$this->object->push($this->element1);
	$this->assertSame(1, $this->object->count());
	$this->object->poll();
	$this->assertSame(0, $this->object->count());
    }
    
    public function testElementIsNotRemovedAfterTop() {
	$this->object->push($this->element1);
	$this->assertSame(1, $this->object->count());
	$this->object->top();
	$this->assertSame(1, $this->object->count());
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
	 $this->assertInstanceOf('\tjsd\collections\iterators\Iterator', $this->object->getIterator());
    }
    
    public function testClearRemovesAllElements() {
	$this->object->push($this->element1);
	$this->object->clear();
	$this->assertTrue($this->object->isEmpty());
    }
    
    public function test__toStringRetursSerializedAsArray() {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
    
    public function testUsesStrongComparisonForSearching() {
	$element = new types\NumericContainer(1);
	$this->object->push($element);
	$this->assertFalse($this->object->contains(new types\NumericContainer(1)));
	$this->assertTrue($this->object->contains($element));
    }
}