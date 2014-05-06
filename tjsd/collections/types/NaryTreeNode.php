<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections\types;

use InvalidArgumentException;
use tjsd\collections\exceptions\DuplicateEntryException;

class NaryTreeNode implements Comparable, \tjsd\collections\Tree {
    private $value;
    private $parent;
    private $children = array();
    
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

	public function getParent() { 
		return $this->parent;
	}
        
    public function setParent(NaryTreeNode $parentNode) {
		$this->parent = $parentNode;
    }
	
	public function clearParent() {
		$this->parent = null;
	}
    
    public function hasChildren() {
		return $this->childrenCount() > 0;
    }
    
    public function childrenCount() {
		return count($this->children);
    }
    
    public function children() {
		return $this->children;
    }
	
	public function isLeaf() {
		return !$this->hasChildren();
	}
    
	public function depth() {
		$depth = 0;
		
		$currentNode = $this;
		
		while (!is_null($currentNode->getParent())) {
			$depth++;
			$currentNode = $currentNode->getParent();
		}
		
		return $depth;
	}
	
    protected function setValue(Comparable $value) {
		$this->value = $value;
    }
    
    public function insert(Comparable $element) {
		$compareResult = $this->compareToValue($element);
		if($compareResult !== 0) {
			foreach ($this->children as $child) {
				if ($child->getValue()->compareTo($element) === 0) {
					throw new DuplicateEntryException('Value is already present - cannot insert two elements with same value.');
				}
			}
			
			$item = new self($element);
			$item->setParent($this);
			$this->children[] = $item;
		} else {
		   throw new DuplicateEntryException('Value is already present - cannot insert two elements with same value.'); 
		}
    }
    
    public function find(Comparable $element) {
		$compareResult = $this->compareToValue($element);
		if($compareResult === 0) {
			return $this->getValue();
		} else {
			foreach ($this->children as $child) {
				if ($child->getValue()->compareTo($element) === 0) {
					return $child->getValue();
				}
				
				$result = $child->find($element);
				
				if (!is_null($result)) { 
					return $result;
				}
			}
		}
		
		return null;
    }
	
	public function findNode(Comparable $element) {
		$compareResult = $this->compareToValue($element);
		if($compareResult === 0) {
			return $this;
		} else {
			foreach ($this->children as $child) {
				if ($child->getValue()->compareTo($element) === 0) {
					return $child;
				}
				
				$result = $child->find($element);
				
				if (!is_null($result)) { 
					return $result;
				}
			}
		}
		
		return null;
	}
    
    public function remove(Comparable $element) {
		$compareResult = $this->compareToValue($element);
		if ($compareResult === 0) {
			if (!is_null($this->parent)) {
				return $this->parent->remove($element);
			}
		} else {
			foreach ($this->children as $i => $child) {
				if ($child->getValue()->compareTo($element) === 0) {
					$child->clearParent();
					unset($this->children[$i]);
					return true;
				}
				
				$removed = $child->remove($element);
				
				if ($removed)
					return true;
			}
		}
		
		return false;
    }
    
    public function count() {
		$count = 1;
		
		foreach ($this->children as $child) {
			$count += $child->count();
		}
		
		return $count;
    }

    public function __toString() {
		return serialize($this->toArray());
    }

    public function clear() {
		foreach ($this->children as $child) {
			$child->clearParent();
		}
		
		$this->children = array();
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