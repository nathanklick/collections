<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayBoundedQueue extends ArrayQueue {
   private $size;
    
    public function __construct($size, array $initialData = array()) {
        parent::__construct($initialData);
        $this->size = $size;
    }
    
    public function push($element) {
        if($this->isFull()) {
            throw new exceptions\FullCollectionException('Cannot push to full queue.');
        }
        parent::push($element);
    }
    
    public function size() {
        return $this->size;
    }
    
    public function isFull() {
        return $this->count() === $this->size();
    }
    
    public function remainingCapacity() {
        return $this->size() - $this->count();
    }
    
    public function fullness() {
        if($this->count() == 0) {
            return 0.0;
        } else {
            return $this->count() / $this->size();
        }
    }
}