# Homeowner Names
## Assumptions
- The first line of the CSV will be the heading.
- First names are linked to the closest title.
- First names will be more than one character long (This is a safe assumption in the West, but not in the rest of the world)
- A person will have either and initial or a first name and not both.

## Dependancies
- PHP7.4 or above
- PHPunit

## How to Run

	 composer install
     php run.php  

## Running Unit Tests

    ./vendor/bin/phpunit Tests/CSVReaderTest.php
    ./vendor/bin/phpunit Tests/PersonTest.php

## Further thoughts
- A lot of code could be removed by implementing a proper front end data entry system
- Making the Title an Enum or equivalent to improve data storage
- Data providers in tests to run multiple files