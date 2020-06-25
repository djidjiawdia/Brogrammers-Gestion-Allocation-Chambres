<?php

class ChambreDao extends Manager {

    public function __construct(){
        $this->tableName="chambre";
        $this->className="Chambre";
    }

    public function add($obj){
        $sql = "INSERT INTO $this->tableName (num, type, numBat) VALUES (:num, :type, :numBat)";
        return $this->executeUpdate($sql, $obj);
    }

    public function update($obj){

    }

}