<?php

namespace Code\Controller;

use Ausi\SlugGenerator\SlugGenerator;
use Code\Authenticator\CheckUser;
use Code\DB\Connection;
use Code\Entity\Category;
use Code\Entity\Post;
use Code\Entity\User;
use Code\Session\Flash;
use Code\Security\Validator\Sanitizer;
use Code\Security\Validator\Validator;
use Code\View\View;
use Throwable;

class PostsController
{

    use CheckUser;

    public function __construct()
    {
        if (! $this->check()) {
            return header('Location: ' . HOME . '/auth/login');
        }
    }
    
    public function index()
    {
        $view = new View('admin/posts/index.phtml');

        $view->posts = (new Post(Connection::getInstance()))->findAll();

        return $view->render();
    }

    public function new()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $_POST;
    
                $data = Sanitizer::sanitizeData($data, Post::$filters);
    
                if (! Validator::validateRequiredFields($data)) {
                    Flash::add('warning', 'Preencha todos os campos!');
    
                    return header('Location: ' . HOME . '/posts/new');
                }
    
                $post = new Post(Connection::getInstance());

                $data['slug'] = (new SlugGenerator())->generate($data['title']);
                
                if (! $post->insert($data)) {
                    Flash::add('danger', 'Erro ao criar postagem!');
    
                    return header('Location: ' . HOME . '/posts/new');
                }
    
                Flash::add('success', 'Postagem criada com sucesso!');
    
                return header('Location: ' . HOME . '/posts');
            }
    
            $view = new View('admin/posts/new.phtml');
    
            $view->users = (new User(Connection::getInstance()))->findAll('id, first_name, last_name');
            $view->categories = (new Category(Connection::getInstance()))->findAll('id, name');
    
            return $view->render();
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/posts');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/posts');
        }
    }

    public function edit($id = null)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $_POST;
                
                $data = Sanitizer::sanitizeData($data, Post::$filters);
                
                $data['id'] = (int) $id;
    
                if (! Validator::validateRequiredFields($data)) {
                    Flash::add('warning', 'Preencha todos os campos!');
    
                    return header('Location: ' . HOME . '/posts/edit/' . $id);
                }
    
                $post = new Post(Connection::getInstance());
    
                if (! $post->update($data)) {
                    Flash::add('danger', 'Erro ao atualizar postagem!');
    
                    return header('Location: ' . HOME . '/posts/new');
                }
    
                Flash::add('success', 'Postagem atualizada com sucesso!');
    
                return header('Location: ' . HOME . '/posts/edit/' . $id);
            }
    
            $view = new View('admin/posts/edit.phtml');
    
            $view->post = (new Post(Connection::getInstance()))->find($id);
    
            $view->users = (new User(Connection::getInstance()))->findAll('id, first_name, last_name');
            $view->categories = (new Category(Connection::getInstance()))->findAll('id, name');
    
            return $view->render();
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/posts');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/posts');
        }
    }

    public function remove($id = null)
    {
        try {
            $post = new Post(Connection::getInstance());
    
            if (! $post->delete($id)) {
                Flash::add('danger', 'Erro ao remover postagem!');
    
                return header('Location: ' . HOME . '/posts');
            }
    
            Flash::add('success', 'Postagem removida com sucesso!');
    
            return header('Location: ' . HOME . '/posts');
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/posts');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/posts');
        }
    }
}
