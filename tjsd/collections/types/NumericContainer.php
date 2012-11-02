<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

class NumericContainer implements Numeric {
    private $numericValue;
    
    public function __construct($numericValue) {
        $this->numericValue = $numericValue;
    }
    
    public function getNumericValue() {
        return $this->numericValue;
    }
}