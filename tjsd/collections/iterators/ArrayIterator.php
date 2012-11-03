<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

use \tjsd\collections\exceptions\EndOfIteratorException;

/**
 * Iterator over array
 */
class ArrayIterator implements Iterator {
    /** @var array */
    private $data;
    
    /**
     * @param array $initialData
     */
    public function __construct(array $initialData) {
        $this->data = $initialData;
        $this->rewind();
    }
    
    /**
     * @return mixed value at current pointer
     * @throws exceptions\EndOfIteratorException when end of iterator is reached
     */
    public function current() {
        if(!$this->valid()) {
            throw new EndOfIteratorException('Iterator reaches its end. Rewind interator.');
        }
        return current($this->data);
    }

    /**
     * @return string|boolean|integer|float key at current pointer
     * @throws exceptions\EndOfIteratorException when end of iterator is reached
     */
    public function key() {
        if(!$this->valid()) {
            throw new EndOfIteratorException('Iterator reaches its end. Rewind interator.');
        }
        return key($this->data);
    }

    /**
     * Moves pointer to next value
     * 
     * @throws exceptions\EndOfIteratorException when end of iterator is reached
     */
    public function next() {
        if(!$this->valid()) {
            throw new EndOfIteratorException('Iterator reaches its end. Rewind interator.');
        }
        next($this->data);
    }

    /**
     * Rewinds iterator to first possition
     */
    public function rewind() {
        reset($this->data);
    }

    /**
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