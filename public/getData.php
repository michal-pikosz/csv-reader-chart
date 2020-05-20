<?php
require_once "../vendor/autoload.php";
use src\CsvModel;

$csvModel = new CsvModel();
$csvModel->getCountiresCount();
