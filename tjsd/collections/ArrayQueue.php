<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayQueue implements Queue {
    private $data;
    
    public function __construct(array $initialData = array()) {
        $this->data = $initialData;
    }
    
    public function push($element) {
        array_push($this->data, $element);
    }
    
    public function poll() {
        if($this->isEmpty()) {
            throw new exceptions\EmptyCollectionException('Cannot poll from empty queue.');
        }
        return array_shift($this->data);
    }
    
    public function peek() {
        if($this->isEmpty()) {
            throw new exceptions\EmptyCollectionException('Cannot peek empty queue.');
        }
        return reset($this->data);
    }

    public function __toString() {
        return serialize($this->toArray());
    }

    public function clear() {
        $this->data = array();
    }

    public function count() {
        return count($this->data);
    }

    public function getIterator() {
        return new ArrayIterator($this->toArray());
    }

    public function isEmpty() {
        return $this->count() === 0;
    }

    public function toArray() {
        /**
         * Array keys chnges during live cycle of queue. Using array_values() to
         * make sure that array will be indexed starting 0.
         */
        return array_values($this->data);
    }
}