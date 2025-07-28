<?php

namespace App\repository;

interface IUtilisateurRepository
{
    public function selectUserByLoginandPassword($login, $password);
}