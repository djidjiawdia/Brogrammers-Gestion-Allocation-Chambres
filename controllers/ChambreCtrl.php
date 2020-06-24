<?php

class ChambreCtrl extends Controller {
    public function __construct(){
        $this->folder = "chambre";
        $this->layout = "default";
    }

    public function index(){
        $this->data_view = ["title" => "Chambres"];
        $this->view = "index";
        $this->render();
    }
}