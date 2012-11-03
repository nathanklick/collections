<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

use \tjsd\collections\exceptions\EndOfIteratorException;

/**
 * Iterator over given array.
 */
class ArrayIterator implements Iterator {
    
    /** @var array */
    private $data;
    
    /**
     * @param array $initialData data over which the iterator will iterate
     */
    public function __construct(array $initialData) {
        $this->data = $initialData;
        $this->rewind();
    }
    
    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get value from iterator that reaches its end
     *
     * @return mixed value at current pointer
     */
    public function current() {
        if(!$this->valid()) {
            throw new EndOfIteratorException('Iterator reaches its end. Rewind interator.');
        }
        return current($this->data);
    }

    /**
     * {@inheritdoc}
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get value from iterator that reaches its end
     * 
     * @return string|boolean|integer|float key at current pointer
     */
    public function key() {
        if(!$this->valid()) {
            throw new EndOfIteratorException('Iterator reaches its end. Rewind interator.');
        }
        return key($this->data);
    }

    /**
     * {@inheritdoc}
     * 
     * @return void
     * 
     * @throws tjsd\collections\exceptions\EndOfIteratorException when trying to get value from iterator that reaches its end
     */
    public function next() {
        if(!$this->valid()) {
            throw new EndOfIteratorException('Iterator reaches its end. Rewind interator.');
        }
        next($this->data);
    }

    /**
     * {@inheritdoc}
     * 
     * @return void
     */
    public function rewind() {
        reset($this->data);
    }

    /**
     * {@inheritdoc}
     * 
     * @return boolean TRUE if poiter of iterator is valid
     */
    public function valid() {
        /*
         * Cannot use key() method because key() uses valid() method to determine
         * if it's safe to read the key which would lead to recursion. 
         */
        return !is_null(key($this->data));
    }
}