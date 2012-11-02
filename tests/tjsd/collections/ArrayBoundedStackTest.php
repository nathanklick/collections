<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayBoundedStackTest extends \PHPUnit_Framework_TestCase {
   public function testPushPoolWithEmptySpace() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertEquals('foo', $arrayStack->poll());
    }
    
    /**
     * @expectedException \tjsd\collections\exceptions\FullCollectionException
     */
    public function testPushWithNoEmptySpace() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $arrayStack->push('bar');
    }

    public function testSize() {
        $arrayStack = new ArrayBoundedStack(5);
        $this->assertEquals(5, $arrayStack->size());
    }

    public function testIsFullOnFull() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertTrue($arrayStack->isFull());
    }
    
    public function testIsFullOnNotFull() {
        $arrayStack = new ArrayBoundedStack(1);
        $this->assertFalse($arrayStack->isFull());
    }

    public function testRemainingOnEmptyCapacity() {
        $arrayStack = new ArrayBoundedStack(1);
        $this->assertEquals(1, $arrayStack->remainingCapacity());
    }
    
    public function testRemainingOnFullCapacity() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertEquals(0, $arrayStack->remainingCapacity());
    }

    public function testRemainingOnNotFullNorEmptyCapacity() {
        $arrayStack = new ArrayBoundedStack(2);
        $arrayStack->push('foo');
        $this->assertEquals(1, $arrayStack->remainingCapacity());
    }
    
    public function testFullnessOnEmpty() {
        $arrayStack = new ArrayBoundedStack(1);
        $this->assertEquals(0.0, $arrayStack->fullness());
    }
    
    public function testFullnessOnFull() {
        $arrayStack = new ArrayBoundedStack(1);
        $arrayStack->push('foo');
        $this->assertEquals(1.0, $arrayStack->fullness());
    }
    
    public function testFullnessOnHalfFull() {
        $arrayStack = new ArrayBoundedStack(2);
        $arrayStack->push('foo');
        $this->assertEquals(0.5, $arrayStack->fullness());
    }
}