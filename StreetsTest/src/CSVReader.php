<?php

include_once('src/Person.php');

class CSVReader
{
    /**
     * Extract the data as an array from the csv file.
     */
    public function extractDataFromCsv(string $path): array
    {
        $dataArray = [];

        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $dataArray[] = array_values(array_filter($data));
            }
        }

        fclose($handle);
        // remove heading from the array
        array_shift($dataArray);
        return $dataArray;
    }

    public function splitDataType($data): void
    {
        foreach ($data as $people) {
            // remove . from initals such as F. as this prevents the code seeing it as an initial.
            $cleanedPeople = str_replace('.', '', $people[0]);

            // split the data based on if the line refers to one or two people.
            if (str_contains($cleanedPeople, "&") || str_contains($cleanedPeople, "and")) {
                $pair = $this->splitNamePairs($cleanedPeople);
                // these echos could easily be replaced with array creation or database import.
                echo $pair[0]->print();
                echo $pair[1]->print();
            } else {
                $single = $this->createPerson($cleanedPeople);
                echo $single->print();
            }
            // break up pairs and singles, this is for readability of output and can be removed when needed.
            echo "\n";
        }
    }

    public function createPerson($people): Person
    {
        $info = array_values(array_filter(explode(' ', $people)));

        // Title is always first
        $title = $info[0];
        $firstName = null;
        $initial = null;
        // last name is always last
        $lastName = $info[count($info)-1];

        // assumption that we have one or the other.
        if (count($info) > 2) {
            if (strlen($info[1]) > 1) {
                $firstName = $info[1];
            } else {
                $initial = $info[1];
            }
        }

        return new Person($title, $firstName, $initial, $lastName);
    }

    public function splitNamePairs($people): array
    {
        // replace 'and' with '&' to made splitting the people easier.
        $peopleClean = str_replace('and', '&', $people);
        $peopleSplit = explode("&", $peopleClean);

        $firstPerson = $peopleSplit[0];
        $secondPerson = $peopleSplit[1];

        // Secondary person will have at least a title and last name so can be created normally
        $secondPersonObject = $this->createPerson($secondPerson);
        $firstPersonSeperated = explode(' ', $firstPerson);

        // Primary person will either have their own last name, or share the second persons.
        if (count($firstPersonSeperated) > 2) {
            $firstPersonObject = $this->createPerson($firstPerson);
        } else {
            $firstPersonObject = new Person($firstPersonSeperated[0], null, null, $secondPersonObject->getLastName());
        }

        return [
            $firstPersonObject,
            $secondPersonObject
        ];
    }
}