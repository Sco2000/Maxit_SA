<?php

namespace App\core;
use PDO;
use PDOException;

class Database{
    public PDO $pdo;
    private static ?Database $instance = null;

    public function __construct(){
        try{
            $this->pdo = new PDO(DSN, USER, PASS);
            // echo "Connected to the database";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getInstance(): self{
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}