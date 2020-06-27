<?php

class EtudiantDao extends Manager {
    public function __construct(){
        $this->tableName = "etudiant";
    }

    public function add($obj){}
    public function update($obj){}

    public function showStudent($limit, $offset, $mat, $type){
        $sql = "
            SELECT * 
            FROM $this->tableName
        "; 
        if(!empty($mat) && !empty($type)){
            $sql .= "WHERE mat LIKE '{$mat}' AND (type LIKE '{$type}' OR statut LIKE '{$type}')";
        }elseif(!empty($mat) && empty($type)){
            $sql .= "WHERE mat LIKE '{$mat}'";
        }elseif(empty($mat) && !empty($type)){
            $sql .= "WHERE type LIKE '{$type}' OR statut LIKE '{$type}'";
        }
        $sql .= "
            LIMIT {$limit} 
            OFFSET {$offset}
        ";
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

    public function updateEtudiant($obj){
        $sql = "UPDATE $this->tableName SET {$obj['champ']} = :val WHERE id = :id";
        return $this->executeUpdate($sql, ["val" => $obj["val"], "id" => $obj["id"]]);
    }

}