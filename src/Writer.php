<?php

namespace CSVParser;

class Writer
{
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function save(string $filename): void
    {
        $fp = fopen($filename, 'w');
        fputcsv($fp, $this->reader->getHeaders());
        foreach ($this->reader->getData() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}