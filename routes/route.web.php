<?php

use App\controller\SecurityController;
use App\controller\CompteController;
use App\controller\TransactionController;
use App\core\App;

$routes = [
    '/' => [
        'controller' => SecurityController::class,
        'method' => 'index'
    ],
    '/login' => [
        'controller' => SecurityController::class,
        'method' => 'login'
    ],
    '/register' => [
        'controller' => CompteController::class,
        'method' => 'getPrincipalCompte',
        'middleware' => 'auth'
    ],
    '/list_transactions' => [
        'controller' => TransactionController::class,
        'method' => 'getTenLastTransaction',
        'middleware' => 'auth'
    ],
    '/transactions' => [
        'controller' => TransactionController::class,
        'method' => 'index',
        'middleware' => 'auth'
    ],
    '/logout' => [
        'controller' => SecurityController::class,
        'method' => 'logout',
        'middleware' => 'auth'
    ],
    '/all_transactions' => [
        'controller' => TransactionController::class,
        'method' => 'getPaginateTransactions',
        'middleware' => 'auth'
    ],
    '/all_transactions_list' => [
        'controller' => TransactionController::class,
        'method' => 'indexAll',
        'middleware' => 'auth'
    ],
    'logout' => [
        'controller' => SecurityController::class,
        'method' => 'logout',
    ],
    '/form_add_compte' => [
        'controller' => CompteController::class,
        'method' => 'show',
        'middleware' => 'auth'
    ],
    '/add_compte_secondaire' => [
        'controller' => CompteController::class,
        'method' => 'create',
        'middleware' => 'auth'
    ],
    '/liste_comptes' => [
        'controller' => CompteController::class,
        'method' => 'getCompte',
        'middleware' => 'auth'
    ],
    '/show_all_comptes' => [
        'controller' => CompteController::class,
        'method' => 'index',
        'middleware' => 'auth'
    ],
    '/definir_compte_principal' => [
        'controller' => CompteController::class,
        'method' => 'setPrincipal',
        'middleware' => 'auth'
    ]
]; 