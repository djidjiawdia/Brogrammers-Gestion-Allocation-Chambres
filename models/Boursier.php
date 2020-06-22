<?php

class Boursier extends Etudiant {
    private $pension;
    private $montant;
    private $statut;

    public function getPension(){
        return $this->pension;
    }
    
    public function getMontant(){
        return $this->montant;
    }

    public function getStatut(){
        return $this->statut;
    }
    
    public function setPension($pension){
        $this->pension = $pension;
    }
    
    public function setMontant($montant){
        $this->montant = $montant;
    }

    public function setStatut($statut){
        $this->statut = $statut;
    }
    
}