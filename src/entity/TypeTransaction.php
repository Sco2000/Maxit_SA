<?php

namespace App\entity;

enum TypeTransaction: string {
    case DEPOT = 'depot';
    case RETRAIT = 'retrait';
    case PAIEMENT = 'paiement';
}