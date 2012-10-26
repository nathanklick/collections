<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * Array implementation of FIFO collection.
 */
class ArrayQueue implements Queue {
    /** @var array */
    private $data;
    
    /**
     * Creates and fills ArrayStack with data.
     * 
     * Elements from the end of $initialData array will be returned by poll() at last.
     * Keys in $initialData are ignored.
     * 
     * @param array $initialData if set, collection will be filled with this data
     */
    public function __construct(array $initialData = array()) {
        $this->data = array_values($initialData);
    }
    
    /**
     * Add new element to end of queue.
     * 
     * @param mixed $element
     */
    public function push($element) {
        array_push($this->data, $element);
    }
    
    /**
     * Remove element from beginning of queue and return it.
     * 
     * @return mixed
     */
    public function poll() {
        if($this->isEmpty()) {
            throw new exceptions\EmptyCollectionException('Cannot poll from empty queue.');
        }
        return array_shift($this->data);
    }
    
    /**
     * Return element from beginning of queue.
     * 
     * @return mixed
     */
    public function peek() {
        if($this->isEmpty()) {
            throw new exceptions\EmptyCollectionException('Cannot peek empty queue.');
        }
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
     * Creates new iterator over values in Queue. When iterating, values will
     * be returned in order they will be returned by series of calling poll();
     * 
     * @return \tjsd\collections\ArrayIterator iterater over values in queue
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