<?php
/**
 * @author Jakub Tesárek <programmer@jakubtesarek.cz> (http://jakubtesarek.cz)
 * @copyright Copyright (c) 2012, Jakub Tesárek
 */

namespace tjsd\collections;

class NaryTree implements Tree {
    private $rootNode;

    public function insert(types\Comparable $element) {
		if($this->isEmpty()) {
			$this->rootNode = new types\NaryTreeNode($element);
		} else {
			$this->rootNode->insert($element);
		}
    }
    
    public function __toString() {
		return serialize($this->toArray());
    }

    public function clear() {
		$this->rootNode = null;
    }

    public function contains($element) {
		if($element instanceof types\Comparable) {
			return !is_null($this->find($element));
		}
		return FALSE;
    }

    public function find(types\Comparable $element) {
		if(($element instanceof types\Comparable) && !$this->isEmpty()) {
			return $this->rootNode->find($element);
		}
    }
	
	public function findNode(types\Comparable $element) {
		if(($element instanceof types\Comparable) && !$this->isEmpty()) {
			return $this->rootNode->findNode($element);
		}
    }
    
    public function remove(types\Comparable $element) {
		if(!$this->isEmpty()) {
			if ($this->rootNode->getValue()->compareTo($element) === 0) {
				$this->clear();
				return true;
			} else {
				return $this->rootNode->remove($element);
			}
		}
		
		return false;
    }
    
    public function count() {
		if(is_null($this->rootNode)) {
			return 0;
		}
		
		return $this->rootNode->count();
    }

    public function getIterator() {
		return new iterators\ArrayIterator($this->toArray());
    }

    public function isEmpty() {
		return is_null($this->rootNode);
    }

    public function toArray() {
	
    }

    public static function fromCollection(Collection $initialData) {
		$tree = new self();
		foreach($initialData->toArray() as $element) {
			$tree->insert($element);
		}
		return $tree;
    }
}