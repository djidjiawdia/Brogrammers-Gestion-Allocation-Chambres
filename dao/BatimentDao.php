<?php

class BatimentDao extends Manager {
    public function __construct(){
        $this->tableName="batiment";
        $this->className="Batiment";
    }

    public function add($obj){}
    public function update($obj){}

    public function allBat(){
        $sql = "SELECT * FROM $this->tableName";
        return $this->returnObject($sql);
    }
    
}