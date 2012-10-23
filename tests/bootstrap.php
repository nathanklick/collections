<?php
define('DOCUMENT_ROOT', __DIR__ . '/..');

include DOCUMENT_ROOT . '/collections/exceptions/OffsetNotFoundException.php';
include DOCUMENT_ROOT . '/collections/exceptions/EndOfIteratorException.php';

include DOCUMENT_ROOT . '/collections/Collection.php';
include DOCUMENT_ROOT . '/collections/ArrayObject.php';
include DOCUMENT_ROOT . '/collections/Iterator.php';
include DOCUMENT_ROOT . '/collections/ArrayIterator.php';