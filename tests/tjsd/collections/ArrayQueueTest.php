<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayQueueTest extends \PHPUnit_Framework_TestCase {
    protected $arrayQueue;

    protected function setUp() {
        $this->arrayQueue = new ArrayQueue();
    }
    
    public function testPollReturnsFirstPushedElement() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertSame('foo', $this->arrayQueue->poll());
    }

    public function testPeekReturnsFirstPushedElement() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertSame('foo', $this->arrayQueue->poll());
    }
    
    public function testPollRemovesElement() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertSame('foo', $this->arrayQueue->poll());
        $this->assertSame('bar', $this->arrayQueue->poll());
    }
    
    public function testPeekDoesntRemoveElement() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertSame('foo', $this->arrayQueue->peek());
        $this->assertSame('foo', $this->arrayQueue->peek());
    }

    public function test__toStringRetursSerializedArray() {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function testClearRemovesAllElements() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->clear();
        $this->assertTrue($this->arrayQueue->isEmpty());
    }

     public function testCountOnEmptyQueueReturnsZero() {
        $this->assertSame(0, $this->arrayQueue->count());
    }
    
    public function testCountOnNotEmptyQueueReturnsNumberOfElements() {
        $this->arrayQueue->push('foo');
        $this->assertSame(1, $this->arrayQueue->count());
    }
    
    public function testGetIteratorReturnsIterator() {
        $this->assertInstanceOf('\tjsd\collections\iterators\Iterator', $this->arrayQueue->getIterator());
    }

    public function testIsEmptyOnEmptyQueueReturnsTrue() {
        $this->assertTrue($this->arrayQueue->isEmpty());
    }
    
    public function testIsEmptyOnNotEmptyQueueReturnsFalse() {
        $this->arrayQueue->push('foo');
        $this->assertFalse($this->arrayQueue->isEmpty());
    }

    public function testIteration() {
        $iterationData = array('foo', 'bar');
        
        foreach($iterationData as $value) {
            $this->arrayQueue->push($value);
        }
        
        $resultData = array();
        foreach($this->arrayQueue as $value) {
            $resultData[] = $value;
        }
        
        $this->assertSame($iterationData, $resultData);
    }
    
    public function testToArrayReturnsArrayOrderedByPushOrder () {
        $iterationData = array('foo', 'bar');
        
        foreach($iterationData as $value) {
            $this->arrayQueue->push($value);
        }

        $this->assertSame($iterationData, $this->arrayQueue->toArray());
    }
    
    public function testInitialDataEqualsArrayRepresentation() {
        $initialData = array(5 => 'foo', 'bar');
        $arrayStack = new ArrayStack($initialData);
        $this->assertSame(array_values($initialData), $arrayStack->toArray());
    }

    public function testPollOnEmptyQueueThrowsException() {
	$this->setExpectedException(
	    'tjsd\collections\exceptions\EmptyCollectionException', 'Cannot retrieve element. Queue is empty.'
	);
        $this->arrayQueue->poll();
    }
    
    public function testPeekOnEmptyQueueThrowException() {
	$this->setExpectedException(
	    'tjsd\collections\exceptions\EmptyCollectionException', 'Cannot retrieve element. Queue is empty.'
	);
        $this->arrayQueue->peek();
    }
}