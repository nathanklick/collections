<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayBoundedStackTest extends \PHPUnit_Framework_TestCase {
   public function testPushPoolWithEmptySpaceInsertsElement() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertSame('foo', $arrayStack->poll());
    }
    
    public function testPushWithNoEmptySpaceThrowsException() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
	
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\FullCollectionException', 'Cannot push to full stack.'
	);
        $arrayStack->push('bar');
    }

    public function testSizeReturnsMaximalCapacity() {
        $arrayStack = new ArrayBoundedStack(5);
        $this->assertSame(5, $arrayStack->size());
    }

    public function testIsFullOnFullStackReturnsTrue() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertTrue($arrayStack->isFull());
    }
    
    public function testIsFullOnNotFullStackReturnsFalse() {
        $arrayStack = new ArrayBoundedStack(1);
        $this->assertFalse($arrayStack->isFull());
    }

    public function testRemainingCapacityOnEmptyStackReturnsMaximalCapacity() {
        $arrayStack = new ArrayBoundedStack(1);
        $this->assertSame(1, $arrayStack->remainingCapacity());
    }
    
    public function testRemainingCapacityOnFullStackReturnsZero() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertSame(0, $arrayStack->remainingCapacity());
    }

    public function testRemainingCapacityOnNotFullNorEmptyStack() {
        $arrayStack = new ArrayBoundedStack(2);
        $arrayStack->push('foo');
        $this->assertSame(1, $arrayStack->remainingCapacity());
    }
    
    public function testFullnessOnEmptyStackReturnsZero() {
        $arrayStack = new ArrayBoundedStack(1);
        $this->assertSame(0.0, $arrayStack->fullness());
    }
    
    public function testFullnessOnFullStackReturnsOne() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertSame(1.0, $arrayStack->fullness());
    }
    
    public function testFullnessOnHalfFullStackReturnsHalf() {
        $arrayStack = new ArrayBoundedStack(2);
        $arrayStack->push('foo');
        $this->assertSame(0.5, $arrayStack->fullness());
    }
}