<?php

namespace App\repository;
use App\entity\Compte;


interface ICompteRepository
{
    public function selectCompteById(int $id): ?Compte;
    public function selectAllCompte(): ?array;
    public function selectSecondaryCompteByUserId($userId, $page, $limit): ?array;
    public function updateToPrincipal(int $id): bool;
    public function insert($telephone, $solde, $utilisateurId, $type, $soldeComptePrincipal): bool;
}