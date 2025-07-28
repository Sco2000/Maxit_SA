<?php

namespace App\repository;
use App\core\App;
use App\core\abstract\AbstractRepository;
use App\core\Database;
use App\entity\Compte;
use App\entity\TypeCompte;
use App\repository\UtilisateurRepository;


class CompteRepository extends AbstractRepository implements ICompteRepository
{
    private UtilisateurRepository $utilisateurRepository;
    public function __construct(UtilisateurRepository $utilisateurRepository, Database $db){
        parent::__construct($db);
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function selectCompteById($userId): ?Compte{
        try {
            $sql = "SELECT * FROM comptes WHERE utilisateurId = :userId AND typecompte = '".TypeCompte::PRINCIPAL->value."'";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([':userId' => $userId]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            // var_dump($result); die;
            $compte  = Compte::toObject($result);
            if($compte){
                return $compte;
            }
            return null;
            // var_dump($compte); die;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
        
    }

    public function selectAllCompte(): ?array{
        try {
            $sql = "SELECT * FROM comptes";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();
            $comptes = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $compte = Compte::toObject($row);
                $comptes[] = $compte;
            }
            if($comptes){
                return $comptes;
            }
            return null;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function insert($telephone, $solde, $utilisateurId, $type, $soldeComptePrincipal): bool{
        try {
            
            $this->db->pdo->beginTransaction();
            $sql = "INSERT INTO comptes (telephone, solde, utilisateurId, typecompte) VALUES (:telephone, :solde, :utilisateurId, :typecompte)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':telephone' => $telephone,
                ':solde' => $solde,
                ':utilisateurId' => $utilisateurId,
                ':typecompte' => $type
            ]);
            
            $column = 'solde';
            $sql = "UPDATE comptes SET $column = :value WHERE utilisateurId = :id AND typecompte = '".TypeCompte::PRINCIPAL->value."'";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':value' => $soldeComptePrincipal,
                ':id' => $utilisateurId
            ]);
            $this->db->pdo->commit();
            // var_dump('insert'); die;
            return true;
        } catch (\Throwable $th) {
            $this->db->pdo->rollBack();
            return false;
            throw new \Exception($th->getMessage());
        }
    }

    public function selectSecondaryCompteByUserId($userId, $page, $limit): ?array{
        $offset = ($page-1)*$limit;
        try {
            // var_dump($userId); die;
            // var_dump($offset); die;
            $sql = "SELECT * FROM comptes WHERE utilisateurId = :userId AND typecompte = :typecompte ORDER BY datecreation DESC LIMIT $limit OFFSET $offset";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':userId' => $userId,
                ':typecompte' => TypeCompte::SECONDAIRE->value
            ]);
            
            $comptes = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $compte = Compte::toObject($row);
                $comptes[] = $compte;
            }
            
            if($comptes){
                return $comptes;
            }
            return null;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function CountAll($id){
        try {
            $sql = "SELECT COUNT(*) as total FROM comptes WHERE utilisateurId = :userId AND typecompte = :typecompte";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':userId' => $id,
                'typecompte' => TypeCompte::SECONDAIRE->value
            ]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            // var_dump($result); die;
            return $result;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function UpdateToPrincipal($id): bool{
        try {
            $this->db->pdo->beginTransaction();
            $sql = "UPDATE comptes SET typecompte = :typecompte WHERE typecompte = :typecomptePrincipal";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':typecompte' => TypeCompte::SECONDAIRE->value,
                ':typecomptePrincipal' => TypeCompte::PRINCIPAL->value
            ]);

            $sql = "UPDATE comptes SET typecompte = :typecompte WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':typecompte' => TypeCompte::PRINCIPAL->value,
                ':id' => $id
            ]);
            $this->db->pdo->commit();
            return true;
        } catch (\Throwable $th) {
            $this->db->pdo->rollBack();
            return false;
            throw new \Exception($th->getMessage());
        }
    }
}