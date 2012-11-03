<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

include_once 'BinaryHeapTest_aggregate.php';

class MinHeapTest extends BinaryHeapTest_aggregate {
    protected function createTestObject() {
	return new MinHeap();
    }
    
    public function test__constructWithInitialValuesCreatesHeapFilledWithData() {
	$data = array(
	    new types\NumericContainer(1),
	    new types\NumericContainer(2),
	    new types\NumericContainer(3),
	    new types\NumericContainer(4),
	);
	
	$heap = new MinHeap($data);
	$this->assertEquals($data, $heap->toArray());
    }
    
    public function testPollReturnsSmallestElement() {
	//element2 is bigger than element1
	$this->object->push($this->element2);
	$this->object->push($this->element1);
	$this->assertSame($this->element1, $this->object->poll());
    }
 
    public function testTopReturnsSmallestElement() {
	//element2 is bigger than element1
	$this->object->push($this->element2);
	$this->object->push($this->element1);
	$this->assertSame($this->element1, $this->object->poll());
    }
    
    public function testToArrayReturnsSortedArray() {
	$expectedData = array(
	    $this->element1,
	    $this->element1, //intentionaly
	    $this->element2,
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
    
    public function testMergeCreatesNewMinHeapWithCombinedElements() {
	$heap = $this->createTestObject();
	
	$heap->push($this->element2);
	$heap->push($this->element4);
	
	$this->object->push($this->element1);
	$this->object->push($this->element3);
	
	$resultHeap = $this->object->merge($heap);

	$this->assertInstanceOf('\tjsd\collections\MinHeap', $resultHeap);
	$this->assertSame(4, $resultHeap->count());
    }
    
    public function testPollAndHeapifyWithDataOnRightSideSmallerThanLeft() {
	$this->object->push($this->element3);
	$this->object->push($this->element1);
	$this->object->push($this->element2);
	$this->object->push($this->element4);
	$this->object->push($this->element5);
	$this->object->push($this->element6);
	$this->object->push($this->element7);
	
	$this->assertSame($this->element1, $this->object->poll());
	$this->assertSame($this->element2, $this->object->poll());
    }
}