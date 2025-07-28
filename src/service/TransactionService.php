<?php

namespace App\service;
use App\core\App;
use App\core\Singleton;
use App\entity\Transaction;
use App\repository\TransactionRepository;

class TransactionService extends Singleton implements ITransactionService
{
    private TransactionRepository $transactionRepository;

    private function __construct(TransactionRepository $transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }

    public function getTenLastTransaction(int $id): array{
        $transactionTab = $this->transactionRepository->selectCompteTenLastTransaction($id);
        $transactions = array_map(function ($transaction) {
            return Transaction::toObject($transaction);
        }, $transactionTab);
        return $transactions;
    }

    public function getAllTransactions(int $id): array{
        $transactions = $this->transactionRepository->selectAllCompteTransactions($id);
        $transactionsObjet = array_map(function ($transaction) {
            return Transaction::toObject($transaction);
        }, $transactions);
        return $transactionsObjet;
    }

    public function getTransactionsPaginate($compteId, $page, $limit=6){
        $total = $this->transactionRepository->countAll($compteId);
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