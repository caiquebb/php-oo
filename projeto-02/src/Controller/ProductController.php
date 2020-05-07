<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\Entity\Product;
use Code\View\View;

class ProductController
{
    public function index($id)
    {
        $id = (int) $id;

        $pdo = Connection::getInstance();

        $view = new View('site/single.phtml');

        $view->product = (new Product($pdo))->find($id);

        return $view->render();
    }
}
