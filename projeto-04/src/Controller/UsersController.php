<?php

namespace Code\Controller;

use Code\Authenticator\CheckUser;
use Code\DB\Connection;
use Code\Entity\User;
use Code\Security\PasswordHash;
use Code\Session\Flash;
use Code\Security\Validator\Sanitizer;
use Code\Security\Validator\Validator;
use Code\View\View;
use Throwable;

class UsersController
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
        $view = new View('admin/users/index.phtml');

        $view->posts = (new User(Connection::getInstance()))->findAll();

        return $view->render();
    }

    public function new()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $_POST;
    
                $data = Sanitizer::sanitizeData($data, User::$filters);
    
                if (! Validator::validateRequiredFields($data)) {
                    Flash::add('warning', 'Preencha todos os campos!');
    
                    return header('Location: ' . HOME . '/users/new');
                }
    
                if (! Validator::validatePasswordMinLength($data['password'])) {
                    Flash::add('warning', 'Senha deve conter ao mesno 6 caracteres!');
    
                    return header('Location: ' . HOME . '/users/new');
                }
    
                if (! Validator::validatePasswordConfirm($data['password'], $data['password_confirm'])) {
                    Flash::add('warning', 'Senhas não conferem!');
    
                    return header('Location: ' . HOME . '/users/new');
                }
    
                $post = new User(Connection::getInstance());

                $data['password'] = PasswordHash::hash($data['password']);

                unset($data['password_confirm']);
                
                if (! $post->insert($data)) {
                    Flash::add('danger', 'Erro ao criar usuário!');
    
                    return header('Location: ' . HOME . '/users/new');
                }
    
                Flash::add('success', 'Usuário criada com sucesso!');
    
                return header('Location: ' . HOME . '/users');
            }
    
            $view = new View('admin/users/new.phtml');
    
            $view->users = (new User(Connection::getInstance()))->findAll('id, first_name, last_name');
    
            return $view->render();
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/users');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/users');
        }
    }

    public function edit($id = null)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $_POST;
                
                $data = Sanitizer::sanitizeData($data, User::$filters);
                
                $data['id'] = (int) $id;
    
                if (! Validator::validateRequiredFields($data)) {
                    Flash::add('warning', 'Preencha todos os campos!');
    
                    return header('Location: ' . HOME . '/users/edit/' . $id);
                }

                if ($data['password']) {
                    if (! Validator::validatePasswordMinLength($data['password'])) {
                        Flash::add('warning', 'Senha deve conter ao mesno 6 caracteres!');
        
                        return header('Location: ' . HOME . '/users/new');
                    }
        
                    if (! Validator::validatePasswordConfirm($data['password'], $data['password_confirm'])) {
                        Flash::add('warning', 'Senhas não conferem!');
        
                        return header('Location: ' . HOME . '/users/new');
                    }

                    $data['password'] = PasswordHash::hash($data['password']);
                } else {
                    unset($data['password']);
                }

                unset($data['password_confirm']);
    
                $post = new User(Connection::getInstance());

                if (! $post->update($data)) {
                    Flash::add('danger', 'Erro ao atualizar usuário!');
    
                    return header('Location: ' . HOME . '/users/new');
                }
    
                Flash::add('success', 'Usuário atualizado com sucesso!');
    
                return header('Location: ' . HOME . '/users/edit/' . $id);
            }
    
            $view = new View('admin/users/edit.phtml');
    
            $view->user = (new User(Connection::getInstance()))->find($id);
    
            return $view->render();
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/users');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/users');
        }
    }

    public function remove($id = null)
    {
        try {
            $post = new User(Connection::getInstance());
    
            if (! $post->delete($id)) {
                Flash::add('danger', 'Erro ao remover usuário!');
    
                return header('Location: ' . HOME . '/users');
            }
    
            Flash::add('success', 'Usuário removida com sucesso!');
    
            return header('Location: ' . HOME . '/users');
        } catch (Throwable $e) {
            if (APP_DEBUG) {
                Flash::add('danger', $e->getMessage());
        
                return header('Location: ' . HOME . '/users');
            }
            Flash::add('danger', 'Ocorreu um problema interno, por favor ccontate o admin!');
    
            return header('Location: ' . HOME . '/users');
        }
    }
}
