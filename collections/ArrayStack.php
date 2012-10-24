<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * Array implementation of LIFO collection.
 */
class ArrayStack implements Stack {
    /** @var array */
    private $data;
    
    /**
     * Creates and fills ArrayStack with data.
     * 
     * Elements from the end of $initialData array will be returned by poll() at first.
     * Keys in $initialData are ignored.
     * 
     * @param array $initialData if set, collection will be filled with this data
     */
    public function __construct(array $initialData = array()) {
        $this->data = array_values($initialData);
    }
    
    /**
     * Add new element into Stack
     * 
     * @param mixed $element
     */
    public function push($element) {
        array_unshift($this->data, $element);
    }
    
    /**
     * Remove last inserted element from stack a and return it.
     * 
     * @return mixed
     */
    public function poll() {
        return array_shift($this->data);
    }
    
    /**
     * Return last inserted element from stack.
     * 
     * @return mixed
     */
    public function peek() {
        return reset($this->data);
    }
    
    /**
     * Returns string representation of all elements in collection in serialize format.
     * 
     * @returns string string represenation of collection
     */
    public function __toString() {
        return serialize($this->toArray());
    }
    
    /**
     * Empty collection (remove all elements)
     * 
     * @return NULL
     */
    public function clear() {
        $this->data = array();
    }

    /**
     * @return integer number of elements in collection
     */
    public function count() {
        return count($this->data);
    }

    /**
     * Creates new iterator over values in Stack. When iterating, values will
     * be returned in order they will be returned by series of calling pop();
     * 
     * @return \tjsd\collections\ArrayIterator iterater over values in stack
     */
    public function getIterator() {
        return new ArrayIterator($this->toArray());
    }
    
    /**
     * @return boolean TRUE if collection contains no elements
     */
    public function isEmpty() {
        return $this->count() === 0;
    }

    /**
     * @return array all elements as an array
     */
    public function toArray() {
        /**
         * Array keys chnges during live cycle of queue. Using array_values() to
         * make sure that array will be indexed starting 0.
         */
        return array_values($this->data);
    }
}