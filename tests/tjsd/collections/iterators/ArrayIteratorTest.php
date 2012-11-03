<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\iterators;

class ArrayIteratorTest extends \PHPUnit_Framework_TestCase {

    public function testCurrentOnEmptyIteratorThrowsException() {
        $iterator = new ArrayIterator(array());
	
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\EndOfIteratorException', 'Iterator reaches its end. Rewind interator.'
	);
        $iterator->current();
    }

    public function testCurrentOnNotEmptyIteratorReturnsCurrentElement() {
        $iterator = new ArrayIterator(array('foo' => 'bar'));
        $this->assertSame('bar', $iterator->current());
    }
    
    public function testKeyOnEmptyIteratorThrowsException() {
	$iterator = new ArrayIterator(array());
	
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\EndOfIteratorException', 'Iterator reaches its end. Rewind interator.'
	);
        $iterator->key();
    }

    public function testKeyOnNotEmptyItertorReturnsCurrentKey() {
        $iterator = new ArrayIterator(array('foo' => 'bar'));
        $this->assertSame('foo', $iterator->key());
    }
    
    public function testNextOnEmptyIteratorThrowException() {
	$iterator = new ArrayIterator(array());
	
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\EndOfIteratorException', 'Iterator reaches its end. Rewind interator.'
	);
        $iterator->next();
    }

    public function testNextOnNotEmptyIteratorMovesIteratorToNextElement() {
        $iterator = new ArrayIterator(array('foo' => 'bar', 'oof' => 'rab'));
        $iterator->next();
        $this->assertSame('oof', $iterator->key());
        $this->assertSame('rab', $iterator->current());
    }

    public function testRewindRestartsIteratorToBeginning() {
        $iterator = new ArrayIterator(array('foo' => 'bar', 'oof' => 'rab'));
        $iterator->next();
        $iterator->rewind();
        $this->assertSame('foo', $iterator->key());
        $this->assertSame('bar', $iterator->current());
    }

    public function testValidOnEmptyIteratorReturnsFalse() {
        $iterator = new ArrayIterator(array());
        $this->assertFalse($iterator->valid());
    }

    public function testValidOnNewNotEmptyIteratorReturnsTrue() {
        $iterator = new ArrayIterator(array('foo' => 'bar'));
        $this->assertTrue($iterator->valid());
    }
    
    public function testIteration() {
        $initialData = array(5 => 'foo', 'bar'); 
        $iterator = new ArrayIterator($initialData);
        
        $actualData = array();
        
        foreach($iterator as $key => $value) {
            $actualData[$key] = $value;
        }
        
        $this->assertSame($initialData, $actualData);
    }
}