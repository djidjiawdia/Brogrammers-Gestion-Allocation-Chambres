<?php

class ChambreCtrl extends Controller {
    public function __construct(){
        $this->folder = "chambre";
        $this->layout = "default";
        $this->dao = new ChambreDao();
        $this->validator = new Validator();
    }

    public function index(){
        $this->data_view = ["title" => "Chambres"];
        $this->view = "index";
        $this->render();
    }
    
    public function nouveau(){
        $batiment = new BatimentDao();
        $this->data_view = [
            "title" => "Ajouter une chambre",
            "id" => $this->dao->lastId(),
            "batiments" => $batiment->allBat()
        ];
        $this->view = "addNew";
        $this->render();
    }

    public function addRoom(){
        $resp = [];
        if(isset($_POST['num']) && isset($_POST['type']) && isset($_POST['numBat'])){
            extract($_POST);
            // Validation
            $this->validator->isVide($num, "num", "Le numéro de chambre est obligatoire");
            $this->validator->isVide($type, "type", "Le type de chambre est obligatoire");
            $this->validator->isVide($numBat, "numBat", "Le numero de batiment est obligatoire");
            if($this->validator->isValid()){
                if($this->dao->add($_POST) > 0){
                    $resp = ["type" => "success", "message" => "La chambre est bien enregistrée"];
                }else{
                    $resp = ["type" => "danger", "message" => "L'enregistrement a echoué"];
                }
                echo json_encode($resp);
            }else{
                $resp = ["statut" => "danger", "message" => "Les données sont invalides"];
                echo json_encode($resp);
            }
        }
    }

    public function showRoom(){
        extract($_POST);
        $data = $this->dao->showRooms($limit, $offset);
        $output = "";
        foreach($data as $d){
            $tr =  '';
            $tr = '
                <tr id="'. $d->getId().'">
                    <td>'.$d->getNum().'</td>
                    <td>'. $d->getType().'</td>
                    <td></td>
                    <td>
                        <button class="btn btn-warning editRoom" id="'. $d->getId() .'"><span><i class="fas fa-edit"></i></span></button>
                        <button class="btn btn-danger deleteRoom" id="'. $d->getId() .'"><span><i class="fas fa-trash"></i></span></button>
                    </td>
                </tr>
            ';
            $output .= $tr;
        }
        echo json_encode(["body" => $output, "rows" => count($this->dao->findAll())]);
        //             <tr>
        //                 <td colspan="4">Pas de joueurs</td>
        //             </tr>
        //         </tbody>
        //     </table>
        //     <div class="pagination">
        //         <p>Page :</p>
        //         <ol id="numbers"></ol>
        //     </div>
        // ';
    }
}