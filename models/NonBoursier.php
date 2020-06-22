<?php

class NonBoursier extends Etudiant {
    private $addresse;

    public function getAddresse(){
        return $this->addresse;
    }
    
    public function setAddresse($addresse){
        $this->addresse = $addresse;
    }
    
}