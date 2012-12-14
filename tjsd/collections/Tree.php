<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

use tjsd\collections\types\Comparable;

interface Tree extends Collection {
    public function insert(Comparable $element);
    public function remove(Comparable $element);
    public function find(Comparable $element);
}