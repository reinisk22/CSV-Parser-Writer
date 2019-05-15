<?php

namespace CSVParser;

class Reader
{
    public $filePaths = [];
    protected $headers = [];
    protected $data = [];
    protected $originalHeaders = [];

    public function add(string $filePath): void
    {
        $this->filePaths[] = $filePath;
    }

    public function getHeaders(): void
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

    public function getData()
    {
        // Index of the file being processed
        $i = 0;
        foreach ($this->filePaths as $i => $filePath) {
            $data = array_map('str_getcsv', file($filePath));

            unset($data[0]);

            // Get the mapped data
            $this->data = array_merge($this->data, $this->mapData($i, $data));
        }
    }

    private function mapData($n, $data): array
    {
        $inputColumns = $this->originalHeaders[$n];

        $outputColumns = $this->headers;

        $columnIndex = array_flip($outputColumns);

        $mappedData = [];

        foreach ($data as $row) {
            $workData = array_fill(0, count($this->headers), ' ');

            // Take each input data field and map it to the correct column
            foreach ($row as $j => $value) {

                // Get header name of source column
                $sourceColumn = $inputColumns[$j];

                // Target column for data to go into
                $targetColumnIndex = $columnIndex[$sourceColumn];

                // Place the data into the target column
                $workData[$targetColumnIndex] = $value;
            }
            // Store the mapped data
            $mappedData[] = $workData;
        }
        return $mappedData;
    }
}