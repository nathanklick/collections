<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

class NumericContainer implements Numeric, Comparable {
    private $numericValue;
    
    public function __construct($numericValue) {
        $this->numericValue = $numericValue;
    }
    
    public function getNumericValue() {
        return $this->numericValue;
    }
    
    public function compareTo(Comparable $compared) {
	if(!($compared instanceof self)) {
	    throw new \InvalidArgumentException(sprintf('Cannot compare %s to %s.', __CLASS__, get_class($compared)));
	}
	
	$comparedNumericValue = $compared->getNumericValue();
	if($this->getNumericValue() > $comparedNumericValue) {
	    return 1;
	} elseif ($this->numericValue < $comparedNumericValue) {
	    return -1;
	} else {
	    return 0;
	}
    }
}