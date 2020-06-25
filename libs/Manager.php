<?php

abstract class Manager implements IDao {
    // fermer la connexion
    private $pdo = null;

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

    public function executeUpdate($sql){
        $this->getConnexion();
        $nbreLigne= $this->pdo->exec($sql);
        $this->closeConnexion();
        return $nbreLigne;
    }

    public function executeSelect($sql, $data = null){
        $this->getConnexion();
        //Traitement
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        $data = [];
        foreach( $result as $rowBD){
            //ORM=> tuple BD transformer en Objet
            $data[] = new $this->className($rowBD);//new class($rowBD)     
        }
        $this->closeConnexion();
        return $data;
    }

    public function findAll(){
        $sql = "
            SELECT * 
            FROM $this->tableName
        ";
        return $this->executeSelect($sql);
    }

    public function findById($id){
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";
        $data=$this->executeSelect($sql, ["id" => $id]);
        return count($data)==1?$data[0]:$data;
    }

    public function delete($id){
    $sql="delete from $this->tableName where id=$id";
    return $this->executeUpdate($sql)!=0;
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
    
}