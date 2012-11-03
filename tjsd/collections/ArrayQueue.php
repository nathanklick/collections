<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * Array implementation of FIFO collection.
 */
class ArrayQueue extends ArrayCollectionAggregate implements Queue {

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
            throw new exceptions\EmptyCollectionException('Cannot retrieve element. Queue is empty.');
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
            throw new exceptions\EmptyCollectionException('Cannot retrieve element. Queue is empty.');
        }
        return reset($this->data);
    }

    /**
     * @return array all elements as an array
     */
    public function toArray() {
        /**
         * Array keys chnges during live cycle of queue. Using array_values() to
         * make sure that array will be indexed starting 0.
         */
        return array_values(parent::toArray());
    }
}