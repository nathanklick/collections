<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

class InfiniteIteratorIterator extends IteratorIterator {
    
    public function valid() {
	$this->rewindIfEndIsReached();
        return $this->iterator->valid();
    }
    
    protected function rewindIfEndIsReached() {
	if(!$this->iterator->valid()) {
	    $this->rewind();
	}
    }
    
    public function next() {
	$this->rewindIfEndIsReached();
        $this->iterator->next();
    }
    
    public function key() {
	$this->rewindIfEndIsReached();
        return $this->iterator->key();
    }
    
    public function current() {
	$this->rewindIfEndIsReached();
        return $this->iterator->current();
    }
}
