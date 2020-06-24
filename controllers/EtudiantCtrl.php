<?php

class EtudiantCtrl extends Controller {

    public function __construct(){
        $this->folder = "etudiant";
        $this->layout = "default";
    }

    public function index(){
        $this->data_view = ["title" => "Etudiant"];
        $this->view = "index";
        $this->render();
        // echo "liste des etudiants";
    }
    
    public function nouveau(){
        echo "ajouter nouveau etudiant";
    }
    
}