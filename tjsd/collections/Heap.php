<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

interface Heap extends Collection {
    public function push(types\Numeric $element);
    public function poll();
    public function top();
    public function merge(Heap $mergedHeap);
}