<?php

namespace Code\Controller;

use Code\Authenticator\CheckUser;
use Code\DB\Connection;
use Code\Entity\Category;
use Code\Entity\Expense;
use Code\Entity\User;
use Code\Session\Session;
use Code\View\View;

class MyExpensesController
{
    use CheckUser;

    public function __construct()
    {
        if (!$this->check()) {
            die('Usuário não logado');
        }
    }

    public function index()
    {
        $view = new View('expenses/index.phtml');

        $view->expenses = (new Expense(Connection::getInstance()))->where([ 'users_id' => Session::get('user')['id']]);

        return $view->render();
    }

    public function new()
    {
        $conn = Connection::getInstance();

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST') {
            $data = $_POST;

            $data['users_id'] = Session::get('user')['id'];
            
            $expense = new Expense($conn);
            $expense->insert($data);

            return header('Location: ' . HOME . '/myexpenses');
        }

        $view = new View('expenses/new.phtml');

        $view->categories = (new Category($conn))->findAll();
        $view->users = (new User($conn))->findAll();

        return $view->render();
    }

    public function edit($id)
    {
        $conn = Connection::getInstance();

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST') {
            $data = $_POST;

            $data['id'] = $id;
            
            $expense = new Expense($conn);
            $expense->update($data);

            return header('Location: ' . HOME . '/myexpenses');
        }

        $view = new View('expenses/edit.phtml');

        $view->categories = (new Category($conn))->findAll();
        $view->users = (new User($conn))->findAll();
        $view->expense = (new Expense($conn))->find($id);

        return $view->render();
    }

    public function remove($id)
    {
        $expense = new Expense(Connection::getInstance());

        $expense->delete($id);
        
        return header('Location: ' . HOME . '/myexpenses');
    }
}
