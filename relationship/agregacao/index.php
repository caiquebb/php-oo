<?php

require __DIR__ . '/Product.php';
require __DIR__ . '/Cart.php';

$cart = new Cart;

$p1 = new Product;
$p1->setId(1);
$p1->setName('Produto 1');
$p1->setPrice(10);

$cart->addItem($p1);

$p2 = new Product;
$p2->setId(2);
$p2->setName('Produto 2');
$p2->setPrice(20);

$cart->addItem($p2);

foreach ($cart->getItens() as $item) {
    print $item->getId() . ' ' . $item->getName() . ' ' . $item->getPrice() . "\n";
}
