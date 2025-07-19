<?php

namespace App\repository;
use App\core\App;
use App\core\Database;

class TransactionRepository
{
    private Database $db;

    public function __construct(){
        $this->db = App::getDependency('Database');
    }

    public function selectCompteTenLastTransaction(int $id): array{
        $query = "SELECT * FROM transactions WHERE compteId = :id ORDER BY date DESC LIMIT 10";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $transactions = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $transactions[] = $row;
        }
        // var_dump($transactions); die;
        
        return $transactions;
    }

    public Function selectAllUserTransactions($id): array{
        try {
            $sql = "SELECT * FROM transactions WHERE compteId = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $transactions = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $transactions[] = $row;
            }
            // var_dump($transactions); die;
            return $transactions;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function selectPaginateTransaction($compteId, $page, $limit){
        $offset = ($page-1)*$limit;
        try {
            $sql="SELECT * FROM transactions where compteId = :id ORDER BY DATE DESC LIMIT $limit OFFSET $offset";
            $stmt=$this->db->pdo->prepare($sql);
            $stmt->execute([':id'=> $compteId,]);
            $transactions = [];
            while ($row=$stmt->fetch(\PDO::FETCH_ASSOC)) {
                $transactions[] = $row;
            }
            return $transactions;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
            
        }
    }

    public function countAllTransactions($compteId){
        try {
            $sql = "SELECT COUNT(*) as total FROM transactions WHERE compteId = :id";
            $stmt=$this->db->pdo->prepare($sql);
            $stmt->execute([':id'=>$compteId]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            // var_dump($result); die;
            return $result;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}