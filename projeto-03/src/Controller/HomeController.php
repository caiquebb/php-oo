<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;

class HomeController
{
    public function index()
    {
        // $pdo = Connection::getInstance();

        $view = new View('site/index.phtml');

        return $view->render();
    }
}
