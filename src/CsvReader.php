<?php

namespace src;

class CsvReader
{
    private $file;
    private $csvContents = [];

    /**
     * Get CSV contents
     * @return array
     */
    public function getCsvContents(): array
    {
        return $this->csvContents;
    }

    /**
     * Opens the file in read only mode
     * @return resource
     */
    public function openFile()
    {
        return $this->file = fopen(__DIR__ . "/data.csv", "r");
    }

    /**
     * Writes the contents of the CSV file line by line into a variable
     * @return array
     */
    public function readFile()
    {
        if ($this->openFile() !== FALSE) {
            while (($data = fgetcsv($this->file, 1000, ",")) !== FALSE) {
                $this->csvContents[] = $data;
            }
            $this->closeFile();
        }
        return $this->csvContents;
    }

    /**
     * Closes the file
     * @return bool
     */
    public function closeFile() {
        return fclose($this->file);
    }
}
