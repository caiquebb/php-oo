<?php

interface Animal {
    public function sound();
    public function run($name);
}

class Dog implements Animal
{
    public function sound()
    {
        return 'Au au au';
    }

    public function run($name)
    {
        return $name . ' is running';
    }
}

$dog = new Dog;

print $dog->sound();
print "\n";

print $dog->run('Ted');
print "\n";
