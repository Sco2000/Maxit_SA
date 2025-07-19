<?php

namespace App\service;
use App\repository\UtilisateurRepository;
use App\core\App;

class SecurityService{
    private UtilisateurRepository $utilisateurRepository;
    private static ?SecurityService $instance = null;

    public function __construct(){
        $this->utilisateurRepository = App::getDependency('UtilisateurRepository');
    }

    public static function getInstance(): self{
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }  

    public function getAll($login, $password){
        return $this->utilisateurRepository->selectUserByLoginandPassword($login, $password);
    }
}
