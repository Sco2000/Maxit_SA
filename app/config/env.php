<?php

if(file_exists('../.env')){
    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();
    define('URL', $_ENV['URL']);
    define("USER", $_ENV["DB_USER"]); 
    define("PASS", $_ENV["DB_PASS"]);
    define("DSN", $_ENV["DSN"]);
}
