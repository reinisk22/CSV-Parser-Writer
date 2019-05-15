<?php

namespace CSVParser;

class Mapper
{
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function map(int $n, array $data): array
    {
        $inputColumns = $this->reader->getOriginalHeaders()[$n];

        $outputColumns = $this->reader->getHeaders();

        $columnIndex = array_flip($outputColumns);

        $mappedData = [];

        foreach ($data as $row) {
            $workData = array_fill(0, count($this->reader->getHeaders()), ' ');

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