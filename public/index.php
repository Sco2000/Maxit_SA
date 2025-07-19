<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// phpinfo();
require_once'../vendor/autoload.php';
require_once'../app/config/bootstrap.php';
use App\core\App;

// Charger les dépendances depuis le YAML
App::loadDependenciesFromYaml(__DIR__.'/../app/config/dependencies.yaml');


use App\core\Router;

$routes = Router::resolveRoute($routes);