<?php

include('src/CSVReader.php');
$CSVReader = new CSVReader();
$CSVReader->splitDataType($CSVReader->extractDataFromCsv("examples_(4).csv"));