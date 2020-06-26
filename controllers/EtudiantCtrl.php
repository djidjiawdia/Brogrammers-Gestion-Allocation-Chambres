<?php

class EtudiantCtrl extends Controller {

    public function __construct(){
        $this->folder = "etudiant";
        $this->layout = "default";
        $this->dao = new EtudiantDao();
    }

    public function index(){
        $this->data_view = [
            "title" => "Etudiants"
        ];
        $this->view = "index";
        $this->render();
        // echo "liste des etudiants";
    }

    public function showAll(){
        extract($_POST);
        $etudiant = [];
        $datas = $this->dao->showStudent($limit, $offset);
        foreach($datas as $d){
            if($d->getType() == "boursier"){
                if($d->getStatut() == "logier"){
                    $chambre = new ChambreDao();
                    $d->setChambre(new Chambre($chambre->findById($d->getIdChambre())));
                }
            }
            $etudiant[] = $d;
        }
        $body = '';
        foreach($etudiant as $d){
            $tr = '
                <tr>
                    <td>'.$d->getMat().'</td>
                    <td>'. $d->getPrenom().'</td>
                    <td>'. strtoupper($d->getNom()).'</td>
                    <td>'. $d->getEmail().'</td>
                    <td>'. $d->getTel().'</td>';
                    if($d->getType() == "boursier"){
                        $tr .= '<td>'. $d->getMontant().'</td>';
                        if($d->getStatut() == "logier"){
                            $tr .= '<td>'. $d->getChambre()->getNum().'</td>';
                        }else{
                            $tr .= '<td>Néant</td>';
                        }
                    }else{
                        $tr .= '<td>XOF</td>
                            <td>'. $d->getAdresse().'</td>';
                    }
                    $tr .= '<td class="text-danger">
                        <button class="btn btn-danger deleteStud" id="'. $d->getId().'"><span><i class="fas fa-trash"></i></span></button>
                    </td>
                </tr>
            ';
            $body .= $tr;
        }
        echo $body;
    }
    
    public function nouveau(){
        echo "ajouter nouveau etudiant";
    }
    
}