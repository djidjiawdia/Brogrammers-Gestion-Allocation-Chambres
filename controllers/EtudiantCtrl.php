<?php

class EtudiantCtrl extends Controller {

    public function __construct(){
        $this->folder = "etudiant";
        $this->layout = "default";
        $this->dao = new EtudiantDao();
        $this->validator = new Validator();
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
        $datas = $this->dao->showStudent($limit, $offset, $mat, $type);
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
                <tr id="'. $d->getId().'">
                    <td>'.$d->getMat().'</td>
                    <td class="edit" id="prenom">'. $d->getPrenom().'</td>
                    <td class="edit" id="nom">'. strtoupper($d->getNom()).'</td>
                    <td class="edit" id="email">'. $d->getEmail().'</td>
                    <td class="edit" id="tel">'. $d->getTel().'</td>';
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
                        <button class="btn btn-danger deleteStud" id="'. $d->getId() .'"><span><i class="fas fa-trash"></i></span></button>
                    </td>
                </tr>
            ';
            $body .= $tr;
        }
        echo $body;
    }
    
    public function nouveau(){
        $chambre = new ChambreDao();
        $this->data_view = [
            "title" => "Ajouter un étudiant",
            "chambre" => $chambre->showDispo(),
            "id" => $this->dao->lastId()
        ];
        $this->view = 'nouveau';
        $this->render();
    }

    public function updateEtudiant(){
        if(isset($_POST['id']) && isset($_POST['champ']) && isset($_POST['val'])){
            extract($_POST);
            $this->validator->isVide($val, $champ, "{$champ} est obligatoire");
            if($champ == "email"){
                $this->validator->validWithRegex($val, '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $champ, "$champ invalid");
            }elseif($champ == "tel"){
                $this->validator->validWithRegex($val, '/(7[7860])+([0-9]{7})$/', $champ, "$champ invalid");
            }elseif($champ == "prenom"){
                $this->validator->validWithRegex($val, '/^[A-Za-z ]*$/', $champ, "$champ invalid");
            }
            if($this->validator->isValid()){
                // echo json_encode($this->dao->updateEtudiant($_POST));die();
                if($this->dao->updateEtudiant($_POST)){
                    $resp = ["type" => "success", "message" => "Etudiant modifié"];
                }else{
                    $resp = ["type" => "error", "message" => "Impossoble de modifier"];
                }
            }else{
                $resp = ["statut" => "error", "message" => "Donnée invalide"];
            }
            echo json_encode($resp);
        }
    }

    public function deleteStud(){
        if(isset($_POST['id'])){
            if($this->dao->delete($_POST['id'])){
                $resp = ["type" => "success", "message" => "Etudiant supprimé avec success"];
            }else{
                $resp = ["type" => "error", "message" => "Impossible de supprimer l'étudiant"];
            }
        }
        echo json_encode($resp);
    }
    
}