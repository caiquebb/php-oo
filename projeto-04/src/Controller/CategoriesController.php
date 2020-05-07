<?php

namespace Code\Controller;

use Ausi\SlugGenerator\SlugGenerator;
use Code\Authenticator\CheckUser;
use Code\DB\Connection;
use Code\Entity\Category;
use Code\Session\Flash;
use Code\Security\Validator\Sanitizer;
use Code\Security\Validator\Validator;
use Code\View\View;
use Throwable;

class CategoriesController
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
        $view = new View('admin/categories/index.phtml');

        $view->categories = (new Category(Connection::getInstance()))->findAll();

        return $view->render();
    }

    public function new()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $_POST;
    
                $data = Sanitizer::sanitizeData($data, Category::$filters);
    
                if (! Validator::validateRequiredFields($data)) {
                    Flash::add('warning', 'Preencha todos os campos!');
    
                    return header('Location: ' . HOME . '/categories/new');
                }
    
                $category = new Category(Connection::getInstance());

                $data['slug'] = (new SlugGenerator())->generate($data['name']);
                
                if (! $category->insert($data)) {
                    Flash::add('danger', 'Erro ao criar a categoria!');
    
                    return header('Location: ' . HOME . '/categories/new');
                }
    
                Flash::add('success', 'Categoria criada com sucesso!');
    
                return header('Location: ' . HOME . '/categories');
            }
    
            $view = new View('admin/categories/new.phtml');
    
            return $view->render();
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/categories');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/categories');
        }
    }

    public function edit($id = null)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $_POST;
                
                $data = Sanitizer::sanitizeData($data, Category::$filters);
                
                $data['id'] = (int) $id;
    
                if (! Validator::validateRequiredFields($data)) {
                    Flash::add('warning', 'Preencha todos os campos!');
    
                    return header('Location: ' . HOME . '/categories/edit/' . $id);
                }

                $category = new Category(Connection::getInstance());

                if (! $category->update($data)) {
                    Flash::add('danger', 'Erro ao atualizar a categoria!');
    
                    return header('Location: ' . HOME . '/categories/new');
                }
    
                Flash::add('success', 'Categoria atualizada com sucesso!');
    
                return header('Location: ' . HOME . '/categories/edit/' . $id);
            }
    
            $view = new View('admin/categories/edit.phtml');
    
            $view->category = (new Category(Connection::getInstance()))->find($id);
    
            return $view->render();
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/categories');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/categories');
        }
    }

    public function remove($id = null)
    {
        try {
            $category = new Category(Connection::getInstance());
    
            if (! $category->delete($id)) {
                Flash::add('danger', 'Erro ao remover a categoria!');
    
                return header('Location: ' . HOME . '/categories');
            }
    
            Flash::add('success', 'Categoria removida com sucesso!');
    
            return header('Location: ' . HOME . '/categories');
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/categories');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/categories');
        }
    }
}
