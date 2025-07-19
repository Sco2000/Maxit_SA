<?php

namespace App\entity;
use App\core\abstract\AbstractEntity;

class Compte extends AbstractEntity
{
    private int $id;
    private string $dateCreation;
    private string $telephone;
    private float $solde;
    private array $transactions =[];
    private TypeCompte $etat;

    public function __construct(int $id=0, string $telephone='', string $dateCreation='',float $solde=0.00, TypeCompte $etat = TypeCompte::PRINCIPAL) {
        $this->id = $id;
        $this->telephone = $telephone;
        $this->dateCreation = $dateCreation;    
        $this->solde = $solde;
        $this->transactions = [];
        $this->etat = $etat;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function getSolde(){
        return $this->solde;
    }

    public function setSolde($solde){
        $this->solde = $solde;
    }

    public function getDateCreation(){
        return $this->dateCreation;
    }

    public function setDateCreation($dateCreation){
        $this->dateCreation = $dateCreation;
    }

    public function getEtat(){
        return $this->etat;
    }

    public function setEtat($etat){
        $this->etat = $etat;
    }

    public function getTransactions(){
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction){
        $this->transactions[] = $transaction;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'telephone' => $this->telephone,
            'datecreation' => $this->dateCreation,
            'solde' => $this->solde,
            'typecompte' => $this->etat->value,
            'transactions' => array_map(fn($item) => $item->toArray(), $this->transactions)
        ];
    }

    public static function toObject(array $data): static {
        return new static($data['id'], $data['telephone'], $data['datecreation'], $data['solde'], TypeCompte::from($data['typecompte']));
    }
}