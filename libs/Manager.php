<?php

abstract class Manager implements IDao {
    // fermer la connexion
    private $pdo = null;

    // private $host = "mysql-broogrammers.alwaysdata.net";
    // private $dbname = "broogrammers_allocation_chambre";
    // private $user = "209416";
    // private $pass = "Brogrammer2020";
    private $host = "localhost";
    private $dbname = "gestion_chambre";
    private $user = "root";
    private $pass = "";

    protected $tableName;
    protected $className;

    public function getConnexion(){
        if($this->pdo == null){
            try{
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                die("Erreur de connexion de la BD");
            }
        }
    }

    public function closeConnexion(){
        if($this->pdo != null){
            $this->pdo = null;
        }
    }

    public function executeUpdate($sql, $data = null){
        $this->getConnexion();
        $stmt = $this->pdo->prepare($sql);
        $nbreLigne = $stmt->execute($data);
        $this->closeConnexion();
        return $nbreLigne;
    }

    public function executeSelect($sql, $data = null){
        $this->getConnexion();
        //Traitement
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        $this->closeConnexion();
        return $result;
    }

    public function findAll(){
        $sql = "SELECT * FROM $this->tableName";
        return $this->executeSelect($sql);
    }

    public function findById($id){
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";
        $data=$this->executeSelect($sql, ["id" => $id]);
        return count($data)==1?$data[0]:$data;
    }

    public function delete($id){
        $sql="delete from $this->tableName where id=$id";
        return $this->executeUpdate($sql) != 0;
    }

    public function lastId(){
        $sql = "SELECT id FROM $this->tableName ORDER BY id DESC LIMIT 1";
        $this->getConnexion();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $lastId = $stmt->fetch();
        $this->closeConnexion();
        return $lastId['id'];
    }

    public function returnObject($sql){
        $result = [];
        $data = $this->executeSelect($sql);
        foreach($data as $d){
            $result[] = new $this->className($d);
        }
        return $result;
    }
    
}