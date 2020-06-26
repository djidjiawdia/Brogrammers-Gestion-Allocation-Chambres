<?php

class Etudiant implements IModels {
    protected $id;
    protected $mat;
    protected $nom;
    protected $prenom;
    protected $tel;
    protected $email;
    protected $type;

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
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getMat(){
        return $this->mat;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getTel(){
        return $this->tel;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getType(){
        return $this->type;
    }

    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setMat($mat){
        $this->mat = $mat;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setTel($tel){
        $this->tel = $tel;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setType($type){
        $this->type = $type;
    }

}