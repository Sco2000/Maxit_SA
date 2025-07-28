<?php

namespace App\controller;
use App\core\App;
use App\core\Session;
use App\entity\Compte;  
use App\service\TransactionService;
use App\core\abstract\AbstractController;

class TransactionController extends AbstractController
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService, Session $session){
        parent::__construct($session);
        $this->transactionService = $transactionService;
    }

    public function getTenLastTransaction(){
        $compteArray = $this->session->get('compte');
        $compte = Compte::toObject($compteArray);
        $compteId = $compte->getId();
        $transactions = $this->transactionService->getTenLastTransaction($compteId);
        // var_dump($compte); die;
        // foreach ($transactions as $transaction) {
        //     $compte->addTransaction($transaction);
        // }
        $this->session->set('ten_last_transactions', $transactions);
        header('Location: /transactions');
        // if(count($transactions) > 0){
        //     // var_dump($transactions); die;
        // }
    }

    public function getPaginateTransactions(){
        // var_dump($_GET); die;
        $page= $_GET['page'] ? (int)$_GET['page'] : 1;
        $compteArray = $this->session->get('compte');
        $compte = Compte::toObject($compteArray);
        $compteId = $compte->getId();
        $pagination = [$transactions, $pages] = $this->transactionService->getTransactionsPaginate($compteId, $page);
        // var_dump($pagination); die;
        extract($pagination);
        if(count($transactions) > 0 && isset($pages)){
            $this->session->set('all_transactions', $pagination);

            return $this->render('transactions/listAllTransaction');
        }
    }

    public function index(){
        $this->render('transactions/listTenLastTransaction');
    }
    public function indexAll(){
        $this->render('transactions/listAllTransaction');
    }
}