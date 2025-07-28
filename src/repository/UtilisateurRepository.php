<?php

namespace App\repository;
use App\core\Database;
use App\core\App;
use App\core\abstract\AbstractRepository;
use App\entity\Utilisateur;


class UtilisateurRepository extends AbstractRepository
{
    public function __construct(Database $db){
        parent::__construct($db);
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