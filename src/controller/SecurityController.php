<?php

namespace App\controller;
use App\core\App;
use App\core\Session;
use App\service\SecurityService;
use App\core\abstract\AbstractController;


class SecurityController extends AbstractController
{
    private SecurityService $securityService;
    public function __construct(SecurityService $securityService, Session $session){
        parent::__construct($session);
        $this->commonLayout = 'security';
        $this->securityService = $securityService;
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

    public function inscription(){
        // var_dump($_POST); die;
        // $this->render("connexion/inscription");
    }

    public function identification(){
         $this->render("connexion/form.identite");
    }

    public function logout(){
        $this->session->destroy();
        header('Location: /');
    }
}