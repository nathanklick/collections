<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

/**
 * Array objects allows working with object as if it's an array.
 */
class ArrayObject implements Collection, \ArrayAccess {
    /** @var array */
    private $data;
    
    /**
     * Creates new ArrayObject
     * 
     * @param array $initialData if set, collection will be filled with this data
     */
    public function __construct(array $initialData = array()) {
        $this->data = $initialData;        
    }

    /**
     * Creates new collection using data from another collection
     * 
     * @param \tjsd\collections\Collection $initialData collection providing data to be used
     * @return \self collection filled with given data
     */
    public static function fromCollection(Collection $initialData) {
        return new self($initialData->toArray());
    }
    
    /**
     * @return integer number of elements in collection
     */
    public function count() {
        return count($this->data);
    }

    /**
     * @return \tjsd\collections\ArrayIterator iterater over values in ArrayObject
     */
    public function getIterator() {
        return new ArrayIterator($this->data);
    }

    /**
     * Check if some element is assignet to offset
     * 
     * @param string|boolean|integer|float $offset
     * @return boolean TRUE if value is set to offset
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->data);
    }

    /**
     * Returns elemetn at given offset.
     * 
     * Returns value by reference so you can increment, decrement and manipulate
     * with value without need to reassigne it to ArrayObject again.
     * 
     * <pre><code>
     *  $array = array(0);
     *  $array[0]++;
     *  echo $array[0]; //=> int(1)
     * </code></pre>
     * 
     * Array object operates alike:
     * 
     * <pre><code>
     *  $arrayObject = new ArrayObject(array(0));
     *  $arrayObject[0]++;
     *  echo $arrayObject[0]; //=> int(1)
     * </code></pre>
     * 
     * @param string|boolean|integer|float $offset
     * @return mixed
     * @throws exceptions\OffsetNotFoundException
     */
    public function &offsetGet($offset) {
        if(!$this->offsetExists($offset)) {
            throw new exceptions\OffsetNotFoundException(sprintf('Offset %s is not set.', $offset));
        }
        return $this->data[$offset];
    }

    /**
     * Sets new value to given possition.
     * 
     * You may set $offset to be NULL than first free integer possition is used.
     * 
     * @param string|boolean|integer|float|NULL $offset offset of new element
     * @param mixed $value new value
     */
    public function offsetSet($offset, $value) {
        if(is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * @param string|boolean|integer|float $offset offset of element to be removed
     */
    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }
    
    /**
     * Returns string representation of all elements in collection in serialize format.
     * 
     * @returns string string represenation of collection
     */
    public function __toString() {
        return serialize($this->data);
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
}