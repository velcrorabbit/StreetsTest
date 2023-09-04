<?php

include_once('src/Person.php');

class PersonTest extends PHPUnit\Framework\TestCase
{

    public function testCanBeCreated(): void
    {
        $instance = new Person('Dr', 'Test', 'L', 'McTester');
        $this->assertInstanceOf(Person::class, $instance);
    }

    public function testPrintWithFullDetails()
    {
        $instance = new Person('Dr', 'Test', 'L', 'McTester');
        $expected = '$person[‘title’] => Dr' . "\n" .
                    '$person[‘first_name’] => Test' . "\n" .
                    '$person[‘initial’] => L' . "\n" .
                    '$person[‘last_name’] => McTester' . "\n";
        $this->assertSame($instance->print(), $expected);
    }

    public function testPrintWithMinimalDetails(): void
    {
        $instance = new Person('Dr', null, null, 'McTester');
        $expected = '$person[‘title’] => Dr' . "\n" .
            '$person[‘first_name’] => null' . "\n" .
            '$person[‘initial’] => null' . "\n" .
            '$person[‘last_name’] => McTester' . "\n";
        $this->assertSame($instance->print(), $expected);
    }

    public function testCorrectTitleReturned(): void
    {
        $instance = new Person('Dr', 'Test', 'L', 'McTester');
        $this->assertSame($instance->getTitle(), 'Dr');
    }

    public function testCorrectFirstNameReturned(): void
    {
        $instance = new Person('Dr', 'Test', 'L', 'McTester');
        $this->assertSame($instance->getFirstName(), 'Test');
    }

    public function testCorrectInitialReturned(): void
    {
        $instance = new Person('Dr', 'Test', 'L', 'McTester');
        $this->assertSame($instance->getInitial(), 'L');
    }

    public function testCorrectLastNameReturned(): void
    {
        $instance = new Person('Dr', 'Test', 'L', 'McTester');
        $this->assertSame($instance->getLastName(), 'McTester');
    }
}
