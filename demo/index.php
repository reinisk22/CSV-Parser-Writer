<?php

require_once '../vendor/autoload.php';

use CSVParser\Writer;

$writer = new Writer;

$writer->add('CSVFiles/sample1.csv');
$writer->add('CSVFiles/sample2.csv');
$writer->getHeaders();
$writer->getData();
$writer->writeCSV('CSVFiles/newsample.csv');