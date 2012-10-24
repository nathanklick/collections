<?php
// require class loader
/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require_once __DIR__ . '/../vendor/autoload.php';


/**
define('DOCUMENT_ROOT', __DIR__ . '/..');
//include DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

include DOCUMENT_ROOT . '/collections/exceptions/OffsetNotFoundException.php';
include DOCUMENT_ROOT . '/collections/exceptions/EndOfIteratorException.php';

include DOCUMENT_ROOT . '/collections/Collection.php';
include DOCUMENT_ROOT . '/collections/ArrayObject.php';
include DOCUMENT_ROOT . '/collections/Iterator.php';
include DOCUMENT_ROOT . '/collections/ArrayIterator.php';
include DOCUMENT_ROOT . '/collections/Stack.php';
include DOCUMENT_ROOT . '/collections/ArrayStack.php';
*/