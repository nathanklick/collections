<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * LIFO (last in - first out) collection.
 */
interface Stack extends Collection {
    
    /**
     * Add new element into Stack
     * 
     * @param mixed $element
     */
    public function push($element);
    
    /**
     * Remove last inserted element from stack a and return it.
     * 
     * @return mixed
     */
    public function poll();
    
    /**
     * Return last inserted element from stack.
     * 
     * @return mixed
     */
    public function peek();
}