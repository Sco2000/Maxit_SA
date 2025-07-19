<?php

namespace App\service;
use App\repository\TransactionRepository;
use App\core\App;
use App\entity\Transaction;

class TransactionService
{
    private TransactionRepository $transactionRepository;

    public function __construct(){
        $this->transactionRepository = App::getDependency('TransactionRepository');
    }

    public function getTenLastTransaction(int $id): array{
        $transactionTab = $this->transactionRepository->selectCompteTenLastTransaction($id);
        $transactions = array_map(function ($transaction) {
            return Transaction::toObject($transaction);
        }, $transactionTab);
        return $transactions;
    }

    public function getAllTransactions(int $id): array{
        $transactions = $this->transactionRepository->selectAllUserTransactions($id);
        $transactionsObjet = array_map(function ($transaction) {
            return Transaction::toObject($transaction);
        }, $transactions);
        return $transactionsObjet;
    }

    public function getTransactionsPaginate($compteId, $page, $limit=6){
        $total = $this->transactionRepository->countAllTransactions($compteId);
        extract($total);
        $pages = (int) ceil($total/$limit);
        $transactions=$this->transactionRepository->selectPaginateTransaction($compteId, $page, $limit);
        $transactions = array_map(function ($transaction) {
            return Transaction::toObject($transaction);
        }, $transactions);
        // var_dump($transactions); die;
        return ['transactions'=>$transactions, 'pages'=>$pages];
    }
}