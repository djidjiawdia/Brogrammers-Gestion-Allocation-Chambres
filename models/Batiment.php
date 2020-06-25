<?php

class Batiment implements IModels {
    private $numBat;
    private $libele;

    public function __construct($row = null){
        if($row != null){
            $this->hydrate($row);
        }
    }

    public function hydrate($row){
        $this->numBat = $row["numBat"];
        $this->libele = $row["libele"];
    }

    public function getNumBat(){
        return $this->numBat;
    }

    public function getLibele(){
        return $this->libele;
    }

    
    public function setNumBat($numBat){
        $this->numBat = $numBat;
    }

    public function setLibele($libele){
        $this->libele = $libele;
    }

}