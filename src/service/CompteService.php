<?php

namespace App\service;
use App\repository\CompteRepository;
use App\core\App;
use App\entity\TypeCompte;

class CompteService
{
    private CompteRepository $compteRepository;
    public function __construct(){
        $this->compteRepository = App::getDependency('CompteRepository');
    }

    public function getUserCompte($userId){
        return $this->compteRepository->selectCompteById($userId);
    }

    public function telephoneExist($telephone): bool{
        $comptes = $this->compteRepository->selectAllCompte();
        foreach($comptes as $compte){
            if($compte->getTelephone() == $telephone || empty($telephone)){
                return true;
            }
        }
        return false;
        
    }

    public function addSecondaryCompte($telephone,$soldeComptePrincipal, $solde, $typeCompte, $userId): bool{
        // var_dump($soldeComptePrincipal, $solde); 
        if($soldeComptePrincipal < $solde){
            return false;
        }
        $soldeComptePrincipal = $soldeComptePrincipal - $solde;
        // var_dump($soldeComptePrincipal ); die;
        return $this->compteRepository->insert($telephone, $solde, $userId, $typeCompte, $soldeComptePrincipal);
    }

    public function getUserAllComptes($userId, $page, $comptePrincipal, $limit=5): ?array{
        $total = $this->compteRepository->CountAllCompteByUserId($userId);
        // var_dump($total); die;
        extract($total);
        $pages = (int) ceil($total/$limit);
        $comptes = $this->compteRepository->selectSecondaryCompteByUserId($userId, $page, $limit);
        // var_dump($comptePrincipal); die;
        if($comptes){
            array_unshift($comptes, $comptePrincipal);
           
            return ['comptes'=>$comptes, 'pages'=>$pages];
        }
        return ['comptes'=>[$comptePrincipal], 'pages'=>$pages];
    }

    public function UpdateToPrincipal($id): bool{
        return $this->compteRepository->UpdateToPrincipal($id);
    }
}