<?php

namespace tjsd\collections;

class ArrayIteratorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \tjsd\collections\exceptions\EndOfIteratorException
     */
    public function testCurrentOnEmpty() {
        $iterator = new ArrayIterator(array());
        $iterator->current();
    }

    public function testCurrentOnNonEmpty() {
        $iterator = new ArrayIterator(array('foo' => 'bar'));
        $this->assertEquals('bar', $iterator->current());
    }
    
    /**
     * @expectedException \tjsd\collections\exceptions\EndOfIteratorException
     */
    public function testKeyOnEmpty() {
        $iterator = new ArrayIterator(array());
        $iterator->key();
    }

    public function testKeyOnNonEmpty() {
        $iterator = new ArrayIterator(array('foo' => 'bar'));
        $this->assertEquals('foo', $iterator->key());
    }

    /**
     * @expectedException \tjsd\collections\exceptions\EndOfIteratorException
     */
    public function testNextOnEmpty() {
        $iterator = new ArrayIterator(array());
        $iterator->next();
    }

    public function testNextOnNonEmpty() {
        $iterator = new ArrayIterator(array('foo' => 'bar', 'oof' => 'rab'));
        $iterator->next();
        $this->assertEquals('oof', $iterator->key());
        $this->assertEquals('rab', $iterator->current());
    }

    public function testRewind() {
        $iterator = new ArrayIterator(array('foo' => 'bar', 'oof' => 'rab'));
        $iterator->next();
        $iterator->rewind();
        $this->assertEquals('foo', $iterator->key());
        $this->assertEquals('bar', $iterator->current());
    }

    public function testValidOnEmpty() {
        $iterator = new ArrayIterator(array());
        $this->assertFalse($iterator->valid());
    }

    public function testValidOnNonEmpty() {
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
        
        $this->assertEquals($initialData, $actualData);
    }
}
