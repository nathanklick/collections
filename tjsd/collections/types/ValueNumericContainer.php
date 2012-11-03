<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

class ValueNumericContainer extends NumericContainer {
    private $value;
    
    public function __construct($numericValue, $value) {
	parent::__construct($numericValue);
        $this->value = $value;
    }
    
    public function getValue() {
        return $this->value;
    }
}