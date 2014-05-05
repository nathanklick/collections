<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

use InvalidArgumentException;
use tjsd\collections\exceptions\DuplicateEntryException;

class BinaryTreeNode implements Comparable, \tjsd\collections\Tree {
    private $value;
    private $parent;
    private $leftChild;
    private $rightChild;
    
    public function __construct(Comparable $value) {
	$this->setValue($value);
    }
    
    public function compareTo(Comparable $compared) {
	if(!($compared instanceof self)) {
	    throw new InvalidArgumentException(sprintf('Cannot compare %s to %s.', __CLASS__, get_class($compared)));
	}
	
	return $this->compareToValue($compared->getValue());
    }
    
    protected function compareToValue(Comparable $comparedValue) {
	return $this->value->compareTo($comparedValue);
    }
    
    public function getValue() {
	return $this->value;
    }
    
    public function setLeftChild(TreeNode $childNode) {
	$this->leftChild = $childNode;
	$childNode->setParent($this);
    }
    
    public function setRightChild(TreeNode $childNode) {
	$this->rightChild = $childNode;
	$childNode->setParent($this);
    }
    
    public function removeRightChild() {
	$this->rightChild = NULL;
    }
    
    public function removeLeftChild() {
	$this->leftChild = NULL;
    }
    
    public function setParent(TreeNode $parentNode) {
	$this->parent = $parentNode;
    }
    
    public function hasChild() {
	return $this->childsCount() > 0;
    }
    
    public function hasRightChild() {
	return !is_null($this->rightChild);
    }
    
    public function hasLeftChild() {
	return !is_null($this->leftChild);
    }
    
    public function childsCount() {
	return (int) $this->hasLeftChild() + (int) $this->hasRightChild();
    }
    
    public function leftChild() {
	return $this->leftChild;
    }
    
    public function rightChild() {
	return $this->rightChild;
    }
    
    protected function leftmostChild() {
	if($this->hasLeftChild()) {
	    return $this->leftChild();
	}
	if($this->hasRightChild()) {
	    return $this->rightChild();
	}
    }
    
    protected function rightmostChild() {
	if($this->hasRightChild()) {
	    return $this->rightChild();
	}
	if($this->hasLeftChild()) {
	    return $this->leftChild();
	}
    }
    
    protected function setValue(Comparable $value) {
	$this->value = $value;
    }
    
    public function insert(Comparable $element) {
	$compareResult = $this->compareToValue($element);
	if($compareResult < 0) {
	    if($this->hasRightChild()) {
		$this->rightChild()->insert($element);
	    } else {
		$this->setRightChild(new self($element));
	    }
	} elseif($compareResult > 0) {
	    if($this->hasLeftChild()) {
		$this->leftChild()->insert($element);
	    } else {
		$this->setLeftChild(new self($element));
	    }
	} else {
	   throw new DuplicateEntryException('Value is allready present - cannot insert two elements with same value.'); 
	}
    }
    
    public function find(Comparable $element) {
	$compareResult = $this->compareToValue($element);
	if($compareResult === 0) {
	    return $this->getValue();
	} elseif($compareResult < 0 && $this->hasRightChild()) {
	    return $this->rightChild()->find($element);
	} elseif($compareResult > 0 && $this->hasLeftChild()) {
	    return $this->leftChild()->find($element);
	}
    }
    
    public function remove(Comparable $element) {
	$compareResult = $this->compareToValue($element);
	if($compareResult <= 0 && $this->hasRightChild()) {
	    if($this->rightChild()->compareToValue($element) === 0) {
		if($this->rightChild()->hasRightChild()) {
		    $element = $this->rightChild()->rightChild()->getValue();
		    $this->rightChild()->setValue($element);
		} else {
		    if($this->rightChild()->hasChild()) {
			$this->setRightChild($this->rightChild()->leftmostChild());
		    } else {
			$this->removeRightChild();
		    }
		}
	    }
	    if($this->hasRightChild()) {
		$this->rightChild()->remove($element);
	    }
	} elseif($compareResult >= 0 && $this->hasLeftChild()) {
	    if($this->leftChild()->compareToValue($element) === 0) {
		if($this->leftChild()->hasLeftChild()) {
		    $element = $this->leftChild()->leftChild()->getValue();
		    $this->leftChild()->setValue($element);
		} else {
		    if($this->leftChild()->hasChild()) {
			$this->setLeftChild($this->leftChild()->rightmostChild());
		    } else {
			$this->removeLeftChild();
		    }
		}
	    }
	    if($this->hasLeftChild()) {
		$this->leftChild()->remove($element);
	    }
	}
    }
    
    public function count() {
	return 1
	    + ($this->hasLeftChild() ? $this->leftChild()->count() : 0)
	    + ($this->hasRightChild() ? $this->rightChild()->count() : 0);
    }

    public function __toString() {
	return serialize($this->toArray());
    }

    public function clear() {
	$this->leftChild = NULL;
	$this->rightChild = NULL;
    }

    public function contains($element) {
	return !is_null($this->find($element));
    }

    public function getIterator() {
	return new \tjsd\collections\iterators\ArrayIterator($this->toArray());
    }

    public function isEmpty() {
	return FALSE;
    }

    public function toArray() {
	
    }

    public static function fromCollection(\tjsd\collections\Collection $initialData) {
	foreach($initialData as $element) {
	    $this->insert($element);
	}
    }
}