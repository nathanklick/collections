<?php

namespace tjsd\collections;

class ArrayQueueTest extends \PHPUnit_Framework_TestCase {
 protected $arrayQueue;

    protected function setUp() {
        $this->arrayQueue = new ArrayQueue();
    }
    
    public function testPushPoll() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertEquals('foo', $this->arrayQueue->poll());
    }

    public function testPushPeek() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertEquals('foo', $this->arrayQueue->poll());
    }
    
    public function testPollRemovesElement() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertEquals('foo', $this->arrayQueue->poll());
        $this->assertEquals('bar', $this->arrayQueue->poll());
    }
    
    public function testPeekDoesntRemoveElement() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->push('bar');
        $this->assertEquals('foo', $this->arrayQueue->peek());
        $this->assertEquals('foo', $this->arrayQueue->peek());
    }

    public function test__toString() {
        
    }

    public function testClear() {
        $this->arrayQueue->push('foo');
        $this->arrayQueue->clear();
        $this->assertTrue($this->arrayQueue->isEmpty());
    }

     public function testCountOnEmpty() {
        $this->assertEquals(0, $this->arrayQueue->count());
    }
    
    public function testCountOnNotEmpty() {
        $this->arrayQueue->push('foo');
        $this->assertEquals(1, $this->arrayQueue->count());
    }
    
    public function testGetIterator() {
        $this->assertInstanceOf('\tjsd\collections\Iterator', $this->arrayQueue->getIterator());
    }

    public function testIsEmptyOnEmpty() {
        $this->assertTrue($this->arrayQueue->isEmpty());
    }
    
    public function testIsEmptyOnNonEmpty() {
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
        
        $this->assertEquals($iterationData, $resultData);
    }
    
    public function testToArray() {
        $iterationData = array('foo', 'bar');
        
        foreach($iterationData as $value) {
            $this->arrayQueue->push($value);
        }

        $this->assertEquals($iterationData, $this->arrayQueue->toArray());
    }
    
    public function testInitialDataEqualsArrayRepresentation() {
        $initialData = array(5 => 'foo', 'bar');
        $arrayStack = new ArrayStack($initialData);
        $this->assertEquals(array_values($initialData), $arrayStack->toArray());
    }
}
