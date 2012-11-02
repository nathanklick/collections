<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

class ValueNumericContainer implements Numeric {
    private $numericValue;
    private $value;
    
    public function __construct($numericValue, $value) {
        $this->numericValue = $numericValue;
        $this->value = $value;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function getNumericValue() {
        return $this->numericValue;
    }
}