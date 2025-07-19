<?php

namespace App\controller;
use App\core\abstract\AbstractController;
use App\service\SecurityService;
use App\core\App;

class SecurityController extends AbstractController
{
    private SecurityService $securityService;
    public function __construct(){
        parent::__construct();
        $this->commonLayout = 'security';
        $this->securityService = App::getDependency('SecurityService');
    }
    public function index(){
        $this->render('connexion/connexion');;
    }

    public function login(){
        extract($_POST);

        // Définir les règles de validation
        $rules = [
            'login' => ['required'],
            'password' => ['required'],
        ];

        // Utiliser Validator
        $validator = \App\core\Validator::getInstance();
        $validator::resetError();
        $isValid = $validator->validate(['login' => $login, 'password' => $password], $rules);

        if (!$isValid) {
            $errors = $validator::getErrors();
            $this->session->set('errors', $errors);
            header('Location: /');
            return;
        }

        $user = $this->securityService->getAll($login, $password);
        if($user){
            $this->session->set('user', $user->toArray());
            header('Location: /register');
        }else{
            $this->session->set('errors', ['login' => 'Identifiants invalides']);
            header('Location: /');
        }
    }

    public function logout(){
        $this->session->destroy();
        header('Location: /');
    }
}