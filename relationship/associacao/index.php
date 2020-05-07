<?php

require __DIR__ . '/Publishing.php';
require __DIR__ . '/Book.php';

$pub = new Publishing;
$pub->setName('Editora 1');
$pub->setId(1);

$book = new Book;
$book->setTitle('Livro 1');
$book->setIsbn('112.54323.252');
$book->setPublishing($pub);

print $book->getPublishing()->getName();
