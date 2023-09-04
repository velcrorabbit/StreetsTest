<?php

include_once('src/CSVReader.php');

use PHPUnit\Framework\TestCase;

class CSVReaderTest extends TestCase
{

    public function testCsvReadCorrectly()
    {
        $CSVReader = new CSVReader();
        $actual = $CSVReader->extractDataFromCsv("./Tests/test.csv");
        $expected = [
            ['homeowner'],
            ['Mrs Jane McMaster'],
            ['Mr Tom Staff and Mr John Doe'],
            ['Dr P Gunn'],
            ['Dr & Mrs Joe Bloggs'],
            ['Prof Alex Brogan'],
            ['Mrs Faye Hughes-Eastwood'],
            ['Mr F. Fredrickson']
        ];
        $this->assertSame($expected, $actual);
    }

    /** @dataProvider nameDateProvider */
    public function testSingleNames(String $fullName, String $title, ?String $firstName, ?String $initial, String $lastName): void
    {
        $CSVReader = new CSVReader();
        $person = $CSVReader->createPerson($fullName);
        $this->assertInstanceOf(Person::class, $person);
        $this->assertSame($title, $person->getTitle());
        $this->assertSame($firstName, $person->getFirstName());
        $this->assertSame($initial, $person->getInitial());
        $this->assertSame($lastName, $person->getLastName());
    }

    /** @dataProvider pairedNameDateProvider */
    public function testDataSplitting(String $fullNames, String $title, ?String $firstName, ?String $initial, String $lastName): void
    {
        $CSVReader = new CSVReader();
        $people = $CSVReader->splitNamePairs($fullNames);
        $this->assertInstanceOf(Person::class, $people[0]);
        $this->assertInstanceOf(Person::class, $people[1]);
        $this->assertSame($title, $people[0]->getTitle());
        $this->assertSame($firstName, $people[0]->getFirstName());
        $this->assertSame($initial, $people[0]->getInitial());
        $this->assertSame($lastName, $people[0]->getLastName());
    }

    /**
     * provide a set of names and their expected Person objects
     * @return array
     */
    public static function nameDateProvider(): array
    {
        return [
            ['Dr P Gunn', 'Dr', null, 'P', 'Gunn'],
            ['Mr F Fredrickson', 'Mr', null, 'F', 'Fredrickson'],
            ['Prof Alex Brogan', 'Prof', 'Alex', null, 'Brogan'],
            ['Miss Jones', 'Miss', null, null, 'Jones']
        ];
    }

    /**
     * provide a set of paired names and their expected Person objects
     * @return array
     */
    public static function pairedNameDateProvider(): array
    {
        return [
            ['Dr & Mrs Joe Bloggs', 'Dr', null, null, 'Bloggs'],
            ['Mr Tom Staff and Mr John Doe', 'Mr', 'Tom', null, 'Staff'],
        ];
    }
}
