<?php

namespace App\service;

interface ICompteService
{
    public function getUserCompte($userId);
    public function telephoneExist($telephone): bool;
    public function addSecondaryCompte($telephone,$soldeComptePrincipal, $solde, $typeCompte, $userId): bool;
    public function getUserAllComptes($userId, $page, $comptePrincipal, $limit=5): ?array;
    public function UpdateToPrincipal($id): bool;
}