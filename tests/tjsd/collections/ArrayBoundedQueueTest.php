<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayBoundedQueueTest extends \PHPUnit_Framework_TestCase {
    public function testPushPoolWithEmptySpace() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $arrayQueue->push('foo');
        $this->assertEquals('foo', $arrayQueue->poll());
    }
    
    /**
     * @expectedException \tjsd\collections\exceptions\FullCollectionException
     */
    public function testPushWithNoEmptySpace() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $arrayQueue->push('foo');
        $arrayQueue->push('bar');
    }

    public function testSize() {
        $arrayQueue = new ArrayBoundedQueue(5);
        $this->assertEquals(5, $arrayQueue->size());
    }

    public function testIsFullOnFull() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $arrayQueue->push('foo');
        $this->assertTrue($arrayQueue->isFull());
    }
    
    public function testIsFullOnNotFull() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $this->assertFalse($arrayQueue->isFull());
    }

    public function testRemainingOnEmptyCapacity() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $this->assertEquals(1, $arrayQueue->remainingCapacity());
    }
    
    public function testRemainingOnFullCapacity() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $arrayQueue->push('foo');
        $this->assertEquals(0, $arrayQueue->remainingCapacity());
    }

    public function testRemainingOnNotFullNorEmptyCapacity() {
        $arrayQueue = new ArrayBoundedQueue(2);
        $arrayQueue->push('foo');
        $this->assertEquals(1, $arrayQueue->remainingCapacity());
    }
    
    public function testFullnessOnEmpty() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $this->assertEquals(0.0, $arrayQueue->fullness());
    }
    
    public function testFullnessOnFull() {
        $arrayQueue = new ArrayBoundedQueue(1);
        $arrayQueue->push('foo');
        $this->assertEquals(1.0, $arrayQueue->fullness());
    }
    
    public function testFullnessOnHalfFull() {
        $arrayQueue = new ArrayBoundedQueue(2);
        $arrayQueue->push('foo');
        $this->assertEquals(0.5, $arrayQueue->fullness());
    }
}
