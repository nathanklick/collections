<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

abstract class IteratorIterator implements Iterator, \OuterIterator {
    protected $iterator;
    
    public function __construct(Iterator $internalIterator) {
	$this->iterator = $internalIterator;
	$this->iterator->rewind();
    }
    
    public function current() {
        return $this->iterator->current();
    }

    public function key() {
        return $this->iterator->key();
    }

    public function next() {
        $this->iterator->next();
    }

    public function rewind() {
        $this->iterator->rewind();
    }

    public function valid() {
        return $this->iterator->valid();
    }
    
    public function getInnerIterator() {
	return $this->iterator;
    }
}
