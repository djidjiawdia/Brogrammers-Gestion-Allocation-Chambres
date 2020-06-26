<?php

class Chambre implements IModels {

    private $id;
    private $num;
    private $type;

    private $batiment;

    public function __construct($row = null){
        if($row != null){
            $this->hydrate($row);
        }
    }

    public function hydrate($row){
        $this->id = $row["id"];
        $this->num = $row["num"];
        $this->type = $row["type"];
        $this->batiment = new Batiment();
    }
    
    public function getId(){
        return $this->id;
    }

    public function getNum(){
        return $this->num;
    }

    public function getType(){
        return $this->type;
    }

    public function getBatiment(){
        return $this->batiment;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNum($num){
        $this->num = $num;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setBatiment($batiment){
        $this->batiment = $batiment;
    }

}