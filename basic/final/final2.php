<?php

class User
{
    private $name;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    final public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}

class Administrator extends User
{
    public function setName($name)
    {
        return 'Teste';
    }
}

$adm = new Administrator;
$adm->setName('Admin');

print $adm->getName();
print "\n";
