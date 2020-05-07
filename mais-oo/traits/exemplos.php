<?php

trait MyTrait
{
    public function hello()
    {
        return 'Hello World';
    }
}

trait MyTrait2
{
    public function showName($name)
    {
        return 'Hello, ' . $name;
    }

    public function hello()
    {
        return 'Hello World 2';
    }
}

class Client
{
    use MyTrait, MyTrait2{
        MyTrait2::hello insteadof MyTrait;
        MyTrait::hello as helloMy;
        MyTrait::hello as private helloPrivate;
    }

    public function test()
    {
        return $this->helloPrivate();
    }
}

$cli = new Client;

print $cli->helloMy();
print "\n";
print $cli->hello();
print "\n";
print $cli->showName('Peppao');
print "\n";
print $cli->test();
