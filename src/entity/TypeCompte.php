<?php

namespace App\entity;

enum TypeCompte: string {
    case PRINCIPAL = 'principal';
    case SECONDAIRE = 'secondaire';
}