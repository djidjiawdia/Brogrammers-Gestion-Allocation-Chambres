<?php

class Router {
    private $ctrl;

    public function route(){
        try{
            spl_autoload_register(function($className){
                $pathModels = "./models/{$className}.php";
                $pathDao = "./dao/{$className}.php";
                $pathLibs = "./libs/{$className}.php";
                if(file_exists($pathModels)){
                    require_once( $pathModels);
                }elseif(file_exists($pathDao)){
                    require_once($pathDao); 
                }elseif(file_exists( $pathLibs)){
                    require_once( $pathLibs); 
                }     
            });

            if(isset($_GET['url'])){
                $url = explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
                $ctrlFile = ucfirst(strtolower($url[0]))."Ctrl";
                $pathCtrl = "./controllers/{$ctrlFile}.php";
                if(file_exists($pathCtrl)){
                    require_once($pathCtrl);
                    $this->ctrl = new $ctrlFile();
                    $action = $url[1];
                    if(method_exists($this->ctrl, $action)){
                        $this->ctrl->{$action}();
                    }else{
                        require_once "./controllers/ErreurCtrl.php";
                        $error = new ErreurCtrl();
                        $error->showError("Cette méthode n'existe pas");
                    }
                }else{
                    require_once "./controllers/ErreurCtrl.php";
                    $error = new ErreurCtrl();
                    $error->showError("Le controller n'existe pas");
                }
            }else{
                require_once "./controllers/EtudiantCtrl.php";
                $this->ctrl = new EtudiantCtrl();
                $this->ctrl->index();
            }
        }catch(Exception $ex){

        }
    }
}