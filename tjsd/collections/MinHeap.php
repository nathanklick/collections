<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class MinHeap extends BinaryHeap {
    protected function compareNodes(types\Comparable $firstNode, types\Comparable $secondNode) {
	return -1 * $firstNode->compareTo($secondNode);
    }
}