<?php

namespace App\repository;
use App\core\Database;
use App\core\App;
use App\entity\Utilisateur;


class UtilisateurRepository
{
    private Database $db;
    private static ?UtilisateurRepository $instance = null;

    public function __construct(){
        $this->db = App::getDependency('Database');
    }

    public static function getInstance(): self{
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function selectUserByLoginandPassword($login, $password){
        try {
            $sql= 'SELECT * FROM utilisateurs WHERE login = :login AND password = :password';
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':login'=> $login,
                'password'=> $password
            ]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($result){
                // var_dump(Utilisateur::toObject($result)); die;
                return Utilisateur::toObject($result);
            }
                // var_dump($result); die;
            
            // return null;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}