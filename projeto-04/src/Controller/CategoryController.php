<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\Entity\Category;
use Code\Entity\Post;
use Code\Session\Flash;
use Code\View\View;
use Throwable;

class CategoryController
{
    public function index($slug)
    {
        try {
            $category = new Category(Connection::getInstance());
    
            $view = new View('site/category.phtml');
    
            $category = current($category->where([ 'slug' => $slug ]));

            $view->posts = (new Post(Connection::getInstance()))->where([ 'category_id' => $category['id'] ]);
            $view->category = $category['name'];
    
            return $view->render();
        } catch (Throwable $e) {
            Flash::add('warning', 'Nenhuma Postagem para a cagtegoria ' . $category['name'] . ' foi encontrada!');
            
            return header('Location: ' . HOME . '/');
        }
    }
}
