<?php

require_once '../vendor/autoload.php';

use CSVParser\Reader;
use CSVParser\Writer;

$reader = new Reader;

$reader->add('CSVFiles/sample1.csv');
$reader->add('CSVFiles/sample2.csv');

$writer = new Writer($reader);
$writer->save('CSVFiles/newsample.csv');