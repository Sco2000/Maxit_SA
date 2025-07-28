<?php

namespace App\service;
use App\core\App;
use App\core\Singleton;
use App\repository\UtilisateurRepository;

class SecurityService extends Singleton{
    private UtilisateurRepository $utilisateurRepository;
    private static ?SecurityService $instance = null;

    private function __construct(UtilisateurRepository $utilisateurRepository){
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function getAll($login, $password){
        return $this->utilisateurRepository->selectUserByLoginandPassword($login, $password);
    }
}
