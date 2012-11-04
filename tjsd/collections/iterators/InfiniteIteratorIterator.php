<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

class InfiniteIteratorIterator extends IteratorIterator {
    
    /**
     * Iterator is in valid state if internal iterator is not empty. When end of
     * internal iterator is reached, it automaticly rewinds.
     * 
     * @return boolean TRUE if poiter of iterator is valid
     */
    public function valid() {
	$this->rewindIfEndIsReached();
        return $this->iterator->valid();
    }
    
    /**
     * Checks if internal iterator reached it's end. If so, it automaticly rewinds.
     * 
     * @return void
     */
    protected function rewindIfEndIsReached() {
	if(!$this->iterator->valid()) {
	    $this->rewind();
	}
    }
    
    /**
     * {@inheritdoc}
     * When end of internal iterator is reached, it automaticly rewinds.
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to move pointer of empty iterator
     *
     * @return void
     */
    public function next() {
	$this->rewindIfEndIsReached();
        $this->iterator->next();
    }
    
    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get key from empty iterator
     *
     * @return string|boolean|integer|float key at current pointer
     */
    public function key() {
	$this->rewindIfEndIsReached();
        return $this->iterator->key();
    }
    
    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get value from empty iterator
     *
     * @return mixed value at current pointer
     */
    public function current() {
	$this->rewindIfEndIsReached();
        return $this->iterator->current();
    }
}
