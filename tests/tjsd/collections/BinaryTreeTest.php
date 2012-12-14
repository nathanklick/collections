<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class BinaryTreeTest extends \PHPUnit_Framework_TestCase {
    public function test___contructCreatesNewTree() {
	$tree = new BinaryTree();
	$this->assertInstanceOf('tjsd\collections\BinaryTree', $tree);
    }
    
    public function test_insertedElementIsPresent() {
	$tree = new BinaryTree();
	$element = new types\NumericContainer(1);
	$tree->insert($element);
	$this->assertTrue($tree->contains($element));
    }
    
    public function test_notInsertedElementIsNotPresent() {
	$tree = new BinaryTree();
	$element = new types\NumericContainer(1);
	$this->assertFalse($tree->contains($element));
    }
    
    public function test___insertingTwoEqualElementsWillThrowException() {
	$tree = new BinaryTree();
	$tree->insert(new types\NumericContainer(1));
	
	$this->setExpectedException(
	    '\tjsd\collections\exceptions\DuplicateEntryException', 'Value is allready present - cannot insert two elements with same value.'
	);
	$tree->insert(new types\NumericContainer(1));
    }
    
    public function test_clearRemovesAllElements() {
	$tree = new BinaryTree();
	$tree->insert(new types\NumericContainer(1));
	$tree->clear();
	$this->assertTrue($tree->isEmpty());
    }
    
    public function test_countReturnsNumberOfElements() {
	$tree = new BinaryTree();
	$tree->insert(new types\NumericContainer(1));
	$tree->insert(new types\NumericContainer(2));
	$tree->insert(new types\NumericContainer(3));
	$tree->insert(new types\NumericContainer(4));
	$this->assertSame(4, $tree->count());
    }
    
    public function test_insertedElementCanBeFound() {
	$tree = new BinaryTree();
	$tree->insert(new types\NumericContainer(3));
	$tree->insert(new types\NumericContainer(2));
	$tree->insert(new types\NumericContainer(1));
	$tree->insert(new types\NumericContainer(5));
	$element = new types\NumericContainer(4);
	$tree->insert($element);
	$this->assertSame($element, $tree->find(new types\NumericContainer(4)));
    }
    
    public function test_removeRemovesElement() {
	$tree = new BinaryTree();
	$tree->insert(new types\NumericContainer(3));
	$tree->insert(new types\NumericContainer(2));
	$tree->insert(new types\NumericContainer(1));
	$tree->insert(new types\NumericContainer(5));
	$tree->insert(new types\NumericContainer(4));
	$tree->insert(new types\NumericContainer(7));
	$tree->insert(new types\NumericContainer(6));
	$tree->insert(new types\NumericContainer(8));
	
	$tree->remove(new types\NumericContainer(5));
	print_r($tree->toArray());
    }
}