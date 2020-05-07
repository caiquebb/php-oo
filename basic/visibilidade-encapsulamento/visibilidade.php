<?php

class Person
{
    public $name;
    private $age = '??';

    public function showName()
    {
        return $this->name;
    }

    public function showAge()
    {
        return $this->age;
    }
}

class Woman extends Person
{
    public function showWomanAge()
    {
        return $this->showAge();
    }
}

$person = new Person;

$person->name = 'Caique';
// $person->age = 34;

print $person->name;

print "\n";

$woman = new Woman;

print $woman->showWomanAge();

print "\n";
