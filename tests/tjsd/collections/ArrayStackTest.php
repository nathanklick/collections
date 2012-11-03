<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayStackTest extends \PHPUnit_Framework_TestCase {
    protected $arrayStack;

    protected function setUp() {
        $this->arrayStack = new ArrayStack();
    }
    
    public function testPollReturnsLastPushedElement() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertSame('bar', $this->arrayStack->poll());
    }

    public function testPeekReturnsLastInsertedElement() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertSame('bar', $this->arrayStack->poll());
    }
    
    public function testPollRemovesLastInsertedElement() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertSame('bar', $this->arrayStack->poll());
        $this->assertSame('foo', $this->arrayStack->poll());
    }
    
    public function testPeekDoesntRemoveElement() {
        $this->arrayStack->push('foo');
        $this->arrayStack->push('bar');
        $this->assertSame('bar', $this->arrayStack->peek());
        $this->assertSame('bar', $this->arrayStack->peek());
    }

    public function test__toStringRetursSerializedArray() {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function testClearRemovesAllElements() {
        $this->arrayStack->push('foo');
        $this->arrayStack->clear();
        $this->assertTrue($this->arrayStack->isEmpty());
    }

     public function testCountOnEmptyStackReturnsZero() {
        $this->assertSame(0, $this->arrayStack->count());
    }
    
    public function testCountOnNotEmptyStackReturnsNumberOfElements() {
        $this->arrayStack->push('foo');
        $this->assertSame(1, $this->arrayStack->count());
    }
    
    public function testGetIteratorReturnIterator() {
        $this->assertInstanceOf('\tjsd\collections\iterators\Iterator', $this->arrayStack->getIterator());
    }

    public function testIsEmptyOnEmptyStackReturnsTrue() {
        $this->assertTrue($this->arrayStack->isEmpty());
    }
    
    public function testIsEmptyOnNonEmptyStackReturnsFalse() {
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
        
        $this->assertSame($iterationData, $resultData);
    }
    
    public function testToArrayReturnsArrayWithReversedOrderOfElements() {
        $iterationData = array('foo', 'bar');
        
        foreach(array_reverse($iterationData) as $value) {
            $this->arrayStack->push($value);
        }

        $this->assertSame($iterationData, $this->arrayStack->toArray());
    }
    
    public function testInitialDataEqualsArrayRepresentation() {
        $initialData = array(5 => 'foo', 'bar');
        $arrayStack = new ArrayStack($initialData);
        $this->assertSame(array_values($initialData), $arrayStack->toArray());
    }
    
    public function testPollOnEmptyStackThrowsException() {
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\EmptyCollectionException', 'Cannot retrieve element. Stack is empty.'
	);
        $this->arrayStack->poll();
    }
    
    public function testPeekOnEmptyStackThrowsException() {
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\EmptyCollectionException', 'Cannot retrieve element. Stack is empty.'
	);
        $this->arrayStack->peek();
    }
}