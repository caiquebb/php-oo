<?php

declare(strict_types=1);

class Product
{
    private $name;
    private $price;

    /**
     * Get the value of name
     */ 
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
}

class Cart
{
    private $itens = [];

    public function addItens(Product $product)
    {
        $this->itens[] = $product;
    }

    /**
     * Get the value of itens
     */ 
    public function getItens() : array
    {
        return $this->itens;
    }
}

$product = new Product;

$product->setName('Curso PHP');
$product->setPrice(19.99);

$product2 = new Product;

$product2->setName('Curso PHP OO');
$product2->setPrice(21.99);

$cart = new Cart;
$cart->addItens($product);
$cart->addItens($product2);

// print 'Produto: ' . $product->getName() . ' custa ' . $product->getPrice();

var_dump($cart->getItens());
