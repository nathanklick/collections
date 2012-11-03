<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class MaxHeap extends BinaryHeap {
    protected function compareNodes(types\Comparable $firstNode, types\Comparable $secondNode) {
	return $firstNode->compareTo($secondNode);
    }
}