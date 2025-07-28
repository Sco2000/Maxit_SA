<?php

namespace App\repository;

interface ITransactionRepository
{
    public function selectCompteTenLastTransaction(int $id): array;
    public function selectAllCompteTransactions(int $id): array;
    public function selectPaginateTransaction($compteId, $page, $limit);
}