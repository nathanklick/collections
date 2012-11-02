<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

include_once 'BinaryHeapTest_aggregate.php';

class MaxHeapTest extends BinaryHeapTest_aggregate {
    protected function createTestObject() {
	return new MaxHeap();
    }
    
    public function testPollReturnsBiggestElement() {
	//element2 is bigger than element1
	$this->object->push($this->element1);
	$this->object->push($this->element2);
	$this->assertSame($this->element2, $this->object->poll());
    }
    
    public function testTopReturnsBiggestElement() {
	//element2 is bigger than element1
	$this->object->push($this->element1);
	$this->object->push($this->element2);
	$this->assertSame($this->element2, $this->object->poll());
    }

    public function testToArrayReturnsSortedArray() {
	$expectedData = array(
	    $this->element2,
	    $this->element1,
	    $this->element1, //intentionaly
	);
	
	$insertedData = array(
	    $this->element1,
	    $this->element2,
	    $this->element1, //intentionaly
	    
	);
	
	foreach ($insertedData as $element) {
	    $this->object->push($element);
	}
	
	$this->assertSame($expectedData, $this->object->toArray());
    }
    
    public function testMergeCreatesNewMaxHeapWithCombinedElements() {
	$heap = $this->createTestObject();
	
	$heap->push($this->element2);
	$heap->push($this->element4);
	
	$this->object->push($this->element1);
	$this->object->push($this->element3);
	
	$resultHeap = $this->object->merge($heap);

	$this->assertInstanceOf('\tjsd\collections\MaxHeap', $resultHeap);
	$this->assertEquals(4, $resultHeap->count());
    }
}
 