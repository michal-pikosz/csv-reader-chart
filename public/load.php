<?php

require_once "../vendor/autoload.php";

use src\CsvModel;
use src\CsvReader;

$csv = new CsvReader();
$CsvModel = new CsvModel();
$CsvModel->saveAll($csv->readFile());