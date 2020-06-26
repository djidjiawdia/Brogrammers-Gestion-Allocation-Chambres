<?php

class EtudiantDao extends Manager {
    public function __construct(){
        $this->tableName = "etudiant";
    }

    public function add($obj){}
    public function update($obj){}

    public function showStudent($limit, $offset){
    $sql = "SELECT * FROM $this->tableName LIMIT {$limit} OFFSET {$offset}";
        $result = $this->executeSelect($sql);
        $data = [];
        foreach( $result as $rowBD){
            //ORM=> tuple BD transformer en Objet
            if($rowBD["type"] == "boursier"){
                $this->className = "Boursier";
            }else{
                $this->className = "NonBoursier";
            }
            $data[] = new $this->className($rowBD);//new class($rowBD)     
        }
        return $data;
    }

}