<?php

namespace App\controller;
use App\core\App;
use App\core\Session;
use App\entity\Compte;
use App\entity\TypeCompte;
use App\entity\Utilisateur;
use App\service\CompteService;
use App\core\abstract\AbstractController;

class CompteController extends AbstractController
{
    private CompteService $compteService;
    public function __construct(CompteService $compteService, Session $session){
        parent::__construct($session);
        $this->compteService = $compteService;
    }

    public function getPrincipalCompte(){
        // var_dump($this->session->get('user')); die;
        $user = Utilisateur::toObject($this->session->get('user'));
        // var_dump($user); die;
        $userId = $user->getId();
        $comptes = $this->compteService->getUserCompte($userId);
        
        if($comptes){
            $this->session->set('compte', $comptes->toArray());
            // var_dump($comptes); die;
            header('Location: /list_transactions');
            exit;
        }
        header('Location: /');
        
    }

    public function show(){
        $this->render('comptes/form.add.compte');
    }

    public function create(){
        extract($_POST);

        // Définir les règles de validation
        $rules = [
            'telephone' => ['required', 'isSenegalPhone'],
            'solde' => ['required','isNumeric']
        ];

        $validator = \App\core\Validator::getInstance();
        $validator::resetError();
        $isValid = $validator->validate(['telephone' => $telephone, 'solde' => $solde], $rules);

        if (!$isValid) {
            $errors = $validator::getErrors();
            // var_dump($errors); die;
            $this->session->set('errors', $errors);
            header('Location: /form_add_compte');
            return;
        }

        $verif = $this->compteService->telephoneExist($telephone);
        if($verif){
            $errors = ['telephone'=>'Ce numéro de téléphone existe déjà'];
            $this->session->set('errors', $errors);
            header('Location: /form_add_compte');
            exit;
        }
        // $solde = Compte::toObject($this->session->get('compte'))->getSolde();
        // var_dump($solde); die;
        $typeCompte = TypeCompte::SECONDAIRE->value;
        $userId = Utilisateur::toObject($this->session->get('user'))->getId();
        $soldeCompte = Compte::toObject($this->session->get('compte'))->getSolde();
        $newCompte = $this->compteService->addSecondaryCompte($telephone, $soldeCompte, (float)$solde, $typeCompte, $userId);
        // var_dump($newCompte); die;
        if(!$newCompte){
            $errors = ['solde'=>'Erreur lors de la création du compte. Il se peut que ce soit lié au solde.'];
            $this->session->set('errors', $errors);
            header('Location: /form_add_compte');
            exit;
        }
        $comptes = $this->compteService->getUserCompte($userId);
        $this->session->set('compte', $comptes->toArray());
        $this->session->set('success', 'Compte créé avec succès');
        header('Location: /form_add_compte');
    }

    public function getCompte(){
        $page= (int)($_GET['page'] ?? 1);
        $userId = Utilisateur::toObject($this->session->get('user'))->getId();
        $comptePrincipal = Compte::toObject($this->session->get('compte'));
        $pagination = $this->compteService->getUserAllComptes($userId, $page, $comptePrincipal);
        // var_dump($pagination); die;
        if($pagination){
            extract($pagination);
            if(count($comptes) > 0 && isset($pages)){
                // var_dump($comptes, $pages); die;
                $this->session->set('all_comptes', $pagination);
            }
        }
        header('Location: /show_all_comptes');
    }

     public function index(){
        $this->render('comptes/liste.compte');
    }

    public function setPrincipal(){
        extract($_POST);
        $result = $this->compteService->UpdateToPrincipal($id);
        // var_dump($result); die;

        if($result){
            $userId = (Utilisateur::toObject($this->session->get('user')))->getId();
            $compte = $this->compteService->getUserCompte($userId);
            $this->session->set('compte', $compte->toArray());
            $this->session->set('success', 'Compte principal mis à jour avec succès');
            // var_dump($this->session->get('compte')); die;
            header('Location: /liste_comptes');
            exit;
        }

        $this->session->set('error', 'Une erreur est survenue lors du changement du compte principal');
        $this->render('comptes/liste.compte');
    }

    
}