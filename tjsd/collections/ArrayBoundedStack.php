<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayBoundedStack extends ArrayStack {
    private $size;
    
    public function __construct($size, array $initialData = array()) {
        parent::__construct($initialData);
        $this->size = $size;
    }
    
    public function push($element) {
        if($this->isFull()) {
            //TODO
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
        return $this->size / $this->count();
    }
}