<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

abstract class BinaryHeap extends ArrayCollection implements Heap {

    public function __construct(array $initialData = array()) {
	$this->clear();
	foreach($initialData as $element) {
	    $this->push($element);
	}
    }
    
    public function push(types\Comparable $element) {
	$index = $this->lowestFreeIndex();
	$this->data[$index] = $element;
	$this->heapifyUp($index);
    }

    private function heapifyUp($index) {
	if ($index != 0) { // $index == 0 => root
	    $parentIndex = static::parentIndex($index);
	    if ($this->compareNodes($this->data[$index], $this->data[$parentIndex]) == 1) {
		$this->swapElements($parentIndex, $index);
		$this->heapifyUp($parentIndex);
	    }
	}
    }

    private function heapifyDown($index) {
	$highestChildIndex = $this->getHighestChildIndex($index);
	if (!is_null($highestChildIndex) && $this->compareNodes($this->data[$highestChildIndex], $this->data[$index]) == 1 ) {
	    $this->swapElements($index, $highestChildIndex);
	    $this->heapifyDown($highestChildIndex);
	}
    }

    private function getHighestChildIndex($index) {	
	if (isset($this->data[self::leftChildIndex($index)])) {
	    if (isset($this->data[self::rightChildIndex($index)])) {
		if ($this->compareNodes($this->data[static::rightChildIndex($index)], $this->data[self::leftChildIndex($index)]) == 1) {
		    return self::rightChildIndex($index);
		} else {
		    return self::leftChildIndex($index);
		}
	    } else {
		return self::leftChildIndex($index);
	    }
	} else {
	    /*
	     * Because Heap is filled from left to right, it cant happend
	     * that left index will be empty but right index not
	     */
	    return NULL;
	}
    }

    
    public function poll() {
	if($this->isEmpty()) {
            throw new exceptions\EmptyCollectionException('Cannot retrieve element. Heap is empty.');
        }
	$top = $this->extract();
	$this->heapifyDown(0);
	return $top;
    }

    public function top() {
	if($this->isEmpty()) {
            throw new exceptions\EmptyCollectionException('Cannot retrieve element. Heap is empty.');
        }
	return $this->data[0];
    }
    
    private function extract() {
	$result = $this->top();
	$this->swapElements(0, $this->highestUsedIndex());
	unset($this->data[$this->highestUsedIndex()]);
	return $result;
    }

    protected function swapElements($firstIndex, $secondIndex) {
	$temporary = $this->data[$firstIndex];
	$this->data[$firstIndex] = $this->data[$secondIndex];
	$this->data[$secondIndex] = $temporary;
    }

    protected function lowestFreeIndex() {
	return count($this->data);
    }

    protected function highestUsedIndex() {
	return count($this->data) > 0 ? count($this->data) - 1 : NULL;
    }

    protected static function leftChildIndex($rootIndex) {
	return 2 * $rootIndex + 1;
    }

    protected static function rightChildIndex($rootIndex) {
	return 2 * $rootIndex + 2;
    }

    protected static function parentIndex($childIndex) {
	return floor(($childIndex - 1) / 2);
    }

    protected abstract function compareNodes(types\Comparable $firstNode, types\Comparable $secondNode);
    
    public function merge(Heap $mergedHeap) {
	$resultHeap = clone $this;
	foreach($mergedHeap as $element) {
	    $resultHeap->push($element);
	}
	return $resultHeap;
    }
    
    public function toArray() {
	$heap = clone $this;
	$result = array();
	
	while(!$heap->isEmpty()) {
	    $result[] = $heap->poll();
	}
	
	return $result;
    }
}