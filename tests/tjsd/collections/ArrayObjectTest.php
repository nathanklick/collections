<?php
namespace tjsd\collections;

class ArrayObjectTest extends \PHPUnit_Framework_TestCase {
    protected $arrayObject;

    protected function setUp() {
        $this->arrayObject = new ArrayObject();
    }

    public function test__constructWithInitialData() {
        $initialData = array('foo', 'bar');
        $newArrayObject = new ArrayObject($initialData);
        $this->assertEquals($initialData, $newArrayObject->toArray());
    }
    
    public function testFromCollection() {
        $initialData = array('foo', 'bar');
        $collection = $this->getMock('\tjsd\collections\Collection');
        $collection->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($initialData));
        
        $newArrayObject = ArrayObject::fromCollection($collection);
        $this->assertEquals($initialData, $newArrayObject->toArray());
    }
    
    public function testCountOnEmpty() {
        $this->assertEquals(0, $this->arrayObject->count());
    }
    
    public function testCountOnNotEmpty() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertEquals(1, $this->arrayObject->count());
    }

    public function testGetIterator() {
        $this->assertInstanceOf('\tjsd\collections\Iterator', $this->arrayObject->getIterator());
    }

    public function testExistingOffsetExists() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertTrue($this->arrayObject->offsetExists('existingOffset'));
    }
    
    public function testNonExistingOffsetExists() {
        $this->assertFalse($this->arrayObject->offsetExists('nonExistingOffset'));
    }

    public function testOffsetSetAndGet() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertEquals('foo', $this->arrayObject->offsetGet('existingOffset'));
    }

    /**
     * @expectedException \tjsd\collections\exceptions\OffsetNotFoundException
     */
    public function testNonExistingOffsetGet() {
        $this->arrayObject->offsetGet('nonExistingOffset');
    }
    
    /**
     * @expectedException \tjsd\collections\exceptions\OffsetNotFoundException
     */
    public function testOffsetUnsetAndGet() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->arrayObject->offsetUnset('existingOffset');
        $this->arrayObject->offsetGet('existingOffset');
    }

    public function test__toString() {
        $expected = 'a:3:{s:3:"foo";s:3:"bar";i:1;b:1;i:2;a:1:{i:0;a:1:{i:0;b:0;}}}';
        
        $this->arrayObject['foo'] = 'bar';
        $this->arrayObject[1] = TRUE;
        $this->arrayObject[] = array(array(FALSE));
        
        $this->assertEquals($expected, $this->arrayObject->__toString());
    }

    public function testToArray() {
        $expected = array();
        $expected['foo'] = 'bar';
        $expected[1] = TRUE;
        $expected[] = array(array(FALSE));
        
        $this->arrayObject['foo'] = 'bar';
        $this->arrayObject[1] = TRUE;
        $this->arrayObject[] = array(array(FALSE));
        
        $this->assertEquals($expected, $this->arrayObject->toArray());
    }

    public function testIsEmptyOnEmpty() {
        $this->assertTrue($this->arrayObject->isEmpty());
    }
    
    public function testIsEmptyOnNonEmpty() {
        $this->arrayObject->offsetSet('existingOffset', 'foo');
        $this->assertFalse($this->arrayObject->isEmpty());
    }

    public function testClear() {
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
        
        $this->assertEquals($initialData, $actualData);
    }
    
    public function testInitialDataEqualsArrayRepresentation() {
        $initialData = array(5 => 'foo', 'bar');
        $arrayObject = new ArrayObject($initialData);
        $this->assertEquals($initialData, $arrayObject->toArray());
    }
    
    public function testReturningByReference() {
        $arrayObject = new ArrayObject(array(0 => 0));        
        $arrayObject[0]++;
        $this->assertEquals(1, $arrayObject->offsetGet(0));
    }
}