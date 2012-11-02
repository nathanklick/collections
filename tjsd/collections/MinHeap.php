<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class MinHeap extends BinaryHeap {
    protected function compareNodes(types\Numeric $firstNode, types\Numeric $secondNode) {
	if($firstNode->getNumericValue() < $secondNode->getNumericValue()) {
	    return 1;
	} elseif ($firstNode->getNumericValue() > $secondNode->getNumericValue()) {
	    return -1;
	} else {
	    return 0;
	}
    }
}