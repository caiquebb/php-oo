<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\Entity\Product;
use Code\View\View;

class HomeController
{
    public function index()
    {
        $pdo = Connection::getInstance();

        $view = new View('site/index.phtml');

        $view->products = (new Product($pdo))->findAll();

        return $view->render();
    }
}
