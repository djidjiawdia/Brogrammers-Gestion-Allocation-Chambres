<?php

class Boursier extends Etudiant {
    private $pension;
    private $montant;
    private $statut;
    private $idChambre;
    
    private $chambre;

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
        $this->pension = $row["pension"];
        $this->montant = $row["montant"];
        $this->statut = $row["statut"];
        $this->idChambre = $row["idChambre"];
    }
    
    public function getPension(){
        return $this->pension;
    }
    
    public function getMontant(){
        return $this->montant;
    }

    public function getStatut(){
        return $this->statut;
    }
    
    public function getIdChambre(){
        return $this->idChambre;
    }

    public function getChambre(){
        return $this->chambre;
    }
    
    public function setPension($pension){
        $this->pension = $pension;
    }
    
    public function setMontant($montant){
        $this->montant = $montant;
    }

    public function setIdChambre($idChambre){
        $this->idChambre = $idChambre;
    }

    public function setStatut($statut){
        $this->statut = $statut;
    }

    public function setChambre($chambre){
        $this->chambre = $chambre;
    }
    
}