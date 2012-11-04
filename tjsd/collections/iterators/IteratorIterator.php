<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

/**
 * Base class for iterators that iterates over other Iterators or Traversable objects
 */
abstract class IteratorIterator implements Iterator, \OuterIterator {
    
    /** @var \Traversable */
    protected $iterator;
    
    /**
     * @param \Traversable $internalIterator Traversable object over which the iterator will iterate
     */
    public function __construct(\Traversable $internalIterator) {
	$this->iterator = $internalIterator;
	$this->iterator->rewind();
    }
    
    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get value from iterator that reaches its end
     *
     * @return mixed value at current pointer
     */
    public function current() {
        return $this->iterator->current();
    }

    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get key from iterator that reaches its end
     *
     * @return string|boolean|integer|float key at current pointer
     */
    public function key() {
        return $this->iterator->key();
    }

    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to move internal pointer of iterator that reaches its end
     *
     * @return void
     */
    public function next() {
        $this->iterator->next();
    }

    /**
     * {@inheritdoc}
     * 
     * @return void
     */
    public function rewind() {
        $this->iterator->rewind();
    }

    /**
     * {@inheritdoc}
     * 
     * @return boolean TRUE if poiter of iterator is valid
     */
    public function valid() {
        return $this->iterator->valid();
    }
    
    /**
     * {@inheritdoc}
     * 
     * @return \Traversable object over this iterator iterates
     */
    public function getInnerIterator() {
	return $this->iterator;
    }
}