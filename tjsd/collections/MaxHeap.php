<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class MaxHeap extends BinaryHeap {
    protected function compareNodes(types\Numeric $firstNode, types\Numeric $secondNode) {
	if($firstNode->getNumericValue() > $secondNode->getNumericValue()) {
	    $result = 1;
	} elseif ($firstNode->getNumericValue() < $secondNode->getNumericValue()) {
	    $result = -1;
	} else {
	    $result = 0;
	}
	return $result;
    }
}