<?php

class Person
{
    private string $title;
    private ?string $first_name;
    private ?string $initial;
    private string $last_name;

    /**
     * @param string $title
     * @param string|null $first_name
     * @param string|null $initial
     * @param string $last_name
     */
    public function __construct(string $title, ?string $first_name, ?string $initial, string $last_name)
    {
        $this->title = $title;
        $this->first_name = $first_name;
        $this->initial = $initial;
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @return string|null
     */
    public function getInitial(): ?string
    {
        return $this->initial;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     *  print the data in the expected format of the output.
     */
    public function print(): string
    {
        return
            '$person[‘title’] => ' . $this->getTitle() . "\n" .
            '$person[‘first_name’] => ' . ($this->getFirstName() ?? 'null') . "\n" .
            '$person[‘initial’] => ' . ($this->getInitial() ?? 'null') . "\n" .
            '$person[‘last_name’] => ' . $this->getLastName() . "\n";
    }
}