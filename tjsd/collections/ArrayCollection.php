<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * Implements overall functionality of array collection
 */
abstract class ArrayCollection implements Collection {
    protected $data;
    
    /**
     * Creates new collection using data from another collection
     * 
     * @param \tjsd\collections\Collection $initialData collection providing data to be used
     * @return \self collection filled with given data
     */
    public static function fromCollection(Collection $initialData) {
        return new static($initialData->toArray());
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
     * @return array all elements as an array
     */
    public function toArray() {
        return $this->data;
    }
    
    /**
     * @return boolean TRUE if collection contains no elements
     */
    public function isEmpty() {
        return $this->count() === 0;
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
     * Creates new iterator over values in collection.
     * 
     * @return \tjsd\collections\ArrayIterator iterater over values in queue
     */
    public function getIterator() {
        return new iterators\ArrayIterator($this->toArray());
    }
}