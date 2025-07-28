<?php

namespace App\service;

interface ITransactionService
{
    public function getTenLastTransaction(int $id): array;
    public function getAllTransactions(int $id): array;
    public function getTransactionsPaginate($compteId, $page, $limit=6);
}