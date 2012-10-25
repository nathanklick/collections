<?php

namespace tjsd\collections;

class ArrayStackTest extends \PHPUnit_Framework_TestCase {
    protected $arrayStack;

    protected function setUp() {
        $this->arrayStack = new ArrayStack();
    }
    
    public function testPushPoll() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertEquals('bar', $this->arrayStack->poll());
    }

    public function testPushPeek() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertEquals('bar', $this->arrayStack->poll());
    }
    
    public function testPollRemovesElement() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertEquals('bar', $this->arrayStack->poll());
        $this->assertEquals('foo', $this->arrayStack->poll());
    }
    
    public function testPeekDoesntRemoveElement() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertEquals('bar', $this->arrayStack->peek());
        $this->assertEquals('bar', $this->arrayStack->peek());
    }

    public function test__toString() {
        
    }

    public function testClear() {
        $this->arrayStack->push('foo');
        $this->arrayStack->clear();
        $this->assertTrue($this->arrayStack->isEmpty());
    }

     public function testCountOnEmpty() {
        $this->assertEquals(0, $this->arrayStack->count());
    }
    
    public function testCountOnNotEmpty() {
        $this->arrayStack->push('foo');
        $this->assertEquals(1, $this->arrayStack->count());
    }
    
    public function testGetIterator() {
        $this->assertInstanceOf('\tjsd\collections\Iterator', $this->arrayStack->getIterator());
    }

    public function testIsEmptyOnEmpty() {
        $this->assertTrue($this->arrayStack->isEmpty());
    }
    
    public function testIsEmptyOnNonEmpty() {
        $this->arrayStack->push('foo');
        $this->assertFalse($this->arrayStack->isEmpty());
    }

    public function testIteration() {
        $iterationData = array('foo', 'bar');
        
        foreach(array_reverse($iterationData) as $value) {
            $this->arrayStack->push($value);
        }
        
        $resultData = array();
        foreach($this->arrayStack as $value) {
            $resultData[] = $value;
        }
        
        $this->assertEquals($iterationData, $resultData);
    }
    
    public function testToArray() {
        $iterationData = array('foo', 'bar');
        
        foreach(array_reverse($iterationData) as $value) {
            $this->arrayStack->push($value);
        }

        $this->assertEquals($iterationData, $this->arrayStack->toArray());
    }
    
    public function testInitialDataEqualsArrayRepresentation() {
        $initialData = array(5 => 'foo', 'bar');
        $arrayStack = new ArrayStack($initialData);
        $this->assertEquals(array_values($initialData), $arrayStack->toArray());
    }
    
    /**
     * @expectedException \tjsd\collections\exceptions\EmptyCollectionException
     */
    public function testPollOnEmpty() {
        $this->arrayStack->poll();
    }
    
    /**
     * @expectedException \tjsd\collections\exceptions\EmptyCollectionException
     */
    public function testPeekOnEmpty() {
        $this->arrayStack->peek();
    }
}
