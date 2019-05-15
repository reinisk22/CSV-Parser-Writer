<?php

namespace CSVParser;

class Reader
{
    private $filePaths = [];
    private $headers = [];
    private $data = [];
    private $originalHeaders = [];
    private $mapper;

    public function __construct()
    {
        $this->mapper = new Mapper($this);
    }
    public function add(string $filePath): void
    {
        $this->filePaths[] = $filePath;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getOriginalHeaders(): array
    {
        return $this->originalHeaders;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function readHeaders(): void
    {
        foreach ($this->filePaths as $filePath) {
            $fp = fopen($filePath, 'r');

            $headers = fgetcsv($fp);

            $this->originalHeaders[] = $headers;

            fclose($fp);

            // Merge input file headers and get their unique values
            $mergedHeaders = array_unique(array_merge($this->headers, $headers));

            // Reset the index values of the combined header array
            $this->headers = array_values($mergedHeaders);
        }
    }

    public function readData()
    {
        // Index of the file being processed
        foreach ($this->filePaths as $i => $filePath) {
            $data = array_map('str_getcsv', file($filePath));

            unset($data[0]);

            // Get the mapped data
            $this->data = array_merge($this->data, $this->mapper->map($i, $data));
        }
    }
}