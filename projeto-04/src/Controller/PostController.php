<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\Entity\Post;
use Code\Session\Flash;
use Code\View\View;
use Throwable;

class PostController
{
    public function index($slug)
    {
        try {
            $post = new Post(Connection::getInstance());
    
            $view = new View('site/single.phtml');
    
            $view->post = current($post->where([ 'slug' => $slug ]));
    
            return $view->render();
        } catch (Throwable $e) {
            Flash::add('warning', 'Postagem não encontrada!');
            
            return header('Location: ' . HOME . '/');
        }
    }
}
