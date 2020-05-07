<?php

/**
 * __construct, __destruct
 * __set, __get
 * __call, __callStatic
 * __toString
 */
class Produto
{
    public $props = [];

    public function __set($name, $value)
    {
        $this->props[$name] = $value;
    }

    public function __get($name)
    {
        return $this->props[$name];
    }

    public function __call($name, $params)
    {
        var_dump($name, $params);
    }

    public function __callStatic($name, $params)
    {
        var_dump($name, $params);
    }

    public function __toString()
    {
        return json_encode($this->props);
    }
}

$produto = new Produto;

$produto->name = 'Nome do Produto';
$produto->price = 19.99;

var_dump($produto->price);

// var_dump($produto->props);

Produto::getConnecction();

$produto->save('Produto', 9.99);

print $produto;
