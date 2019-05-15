<?php

namespace CSVParser;

class Writer extends Reader
{
    public function writeCSV($filename)
    {
        $fp = fopen($filename, 'w');
        fputcsv($fp, $this->headers);
        foreach ($this->data as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}