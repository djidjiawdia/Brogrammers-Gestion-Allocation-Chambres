<?php

class BatimentDao extends Manager {
    public function __construct(){
        $this->tableName="batiment";
        $this->className="Batiment";
    }

    public function add($obj){}
    public function update($obj){}

    public function allBat(){
        $result = [];
        $data = $this->findAll();
        foreach($data as $d){
            $result[] = new $this->className($d);
        }
        return $result;
    }
    
}