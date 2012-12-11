<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class ArrayObjectTest extends \PHPUnit_Framework_TestCase {
    protected $arrayObject;

    protected function setUp() {
        $this->arrayObject = new ArrayObject();
    }

    public function test__constructWithInitialDataFillsArrayWithData() {
        $initialData = array('foo', 'bar');
        $newArrayObject = new ArrayObject($initialData);
        $this->assertSame($initialData, $newArrayObject->toArray());
    }
    
    public function testFromCollectionCreatesNewArrayObject() {
        $initialData = array('foo', 'bar');
        $collection = $this->getMock('\tjsd\collections\Collection');
        $collection->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($initialData));
        
        $newArrayObject = ArrayObject::fromCollection($collection);
        $this->assertSame($initialData, $newArrayObject->toArray());
    }
    
    public function testCountOnEmptyArrayReturnsZero() {
        $this->assertSame(0, $this->arrayObject->count());
    }
    
    public function testCountOnNotEmptyArrayRetunsNumberOfElements() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertSame(1, $this->arrayObject->count());
    }

    public function testGetIteratorReturnsIterator() {
        $this->assertInstanceOf('\tjsd\collections\iterators\Iterator', $this->arrayObject->getIterator());
    }

    public function testOffsetExistsOnExistingOffsetReturnsTrue() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertTrue($this->arrayObject->offsetExists('existingOffset'));
    }
    
    public function testOffsetExistsOnNotExistingOffsetReturnsFalse() {
        $this->assertFalse($this->arrayObject->offsetExists('nonExistingOffset'));
    }

    public function testOffsetSetSetsOffset() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertSame('foo', $this->arrayObject->offsetGet('existingOffset'));
    }

    public function testOffsetGetOnNotExistingOffsetThrowsException() {
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\OffsetNotFoundException', 'Offset nonExistingOffset is not set.'
	);
        $this->arrayObject->offsetGet('nonExistingOffset');
    }
    
    public function testOffsetUnsetUnsetsOffset() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->arrayObject->offsetUnset('existingOffset');
	
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\OffsetNotFoundException', 'Offset existingOffset is not set.'
	);
        $this->arrayObject->offsetGet('existingOffset');
    }

    public function test__toStringReturnsSerializedArray() {
        $expected = 'a:3:{s:3:"foo";s:3:"bar";i:1;b:1;i:2;a:1:{i:0;a:1:{i:0;b:0;}}}';
        
        $this->arrayObject['foo'] = 'bar';
        $this->arrayObject[1] = TRUE;
        $this->arrayObject[] = array(array(FALSE));
        
        $this->assertSame($expected, $this->arrayObject->__toString());
    }

    public function testToArrayReturnsArrayWithPreservedKeys() {
        $expected = array();
        $expected['foo'] = 'bar';
        $expected[1] = TRUE;
        $expected[] = array(array(FALSE));
        
        $this->arrayObject['foo'] = 'bar';
        $this->arrayObject[1] = TRUE;
        $this->arrayObject[] = array(array(FALSE));
        
        $this->assertSame($expected, $this->arrayObject->toArray());
    }

    public function testIsEmptyOnEmptyArrayReturnsTrue() {
        $this->assertTrue($this->arrayObject->isEmpty());
    }
    
    public function testIsEmptyOnNotEmptyArrayReturnsFalse() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertFalse($this->arrayObject->isEmpty());
    }

    public function testClearRemovesAllElements() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->arrayObject->clear();
        $this->assertTrue($this->arrayObject->isEmpty());
    }
    
     public function testIteration() {
        $initialData = array(5 => 'foo', 'bar'); 
        $arrayObject = new ArrayObject($initialData);
        
        $actualData = array();
        
        foreach($arrayObject as $key => $value) {
            $actualData[$key] = $value;
        }
        
        $this->assertSame($initialData, $actualData);
    }
    
    public function testInitialDataEqualsArrayRepresentation() {
        $initialData = array(5 => 'foo', 'bar');
        $arrayObject = new ArrayObject($initialData);
        $this->assertSame($initialData, $arrayObject->toArray());
    }
    
    public function testElementsAreReturnedAsReference() {
        $arrayObject = new ArrayObject(array(0 => 0));
        $arrayObject[0]++;
        $this->assertSame(1, $arrayObject->offsetGet(0));
    }
    
    public function testUsesStrongComparisonForSearching() {
	$arrayObject = new ArrayObject();
	$element = (object) array(1);
	$arrayObject[0] = $element;
	
	$this->assertFalse($arrayObject->contains((object) array(1)));
	$this->assertTrue($arrayObject->contains($element));
    }
}