<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * General purpose collection interface.
 */
interface Collection extends \Countable, \IteratorAggregate {
    
    /**
     * Returns string representation of all elements in collection in serialize format.
     * 
     * @returns string string represenation of collection
     */
    public function __toString();
    
    /**
     * @return array all elements as an array
     */
    public function toArray();
    
    /**
     * @return boolean TRUE if collection contains no elements
     */
    public function isEmpty();
    
    /**
     * Empty collection (remove all elements)
     * 
     * @return NULL
     */
    public function clear();
    
    /**
     * Creates collection from data from given Collection
     * 
     * @param \tjsd\collections\Collection $initialData
     */
    public static function fromCollection(Collection $initialData);
}