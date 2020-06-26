<?php

class NonBoursier extends Etudiant {
    private $adresse;

    public function __construct($row = null){
        if($row != null){
            $this->hydrate($row);
        }
    }

    public function hydrate($row){
        $this->id = $row["id"];
        $this->mat = $row["mat"];
        $this->nom = $row["nom"];
        $this->prenom = $row["prenom"];
        $this->email = $row["email"];
        $this->tel = $row["tel"];
        $this->type = $row["type"];
        $this->adresse = $row["adresse"];
    }
    
    public function getAdresse(){
        return $this->adresse;
    }
    
    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }
    
}