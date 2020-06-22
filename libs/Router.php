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

            
        }catch(Exception $ex){

        }
    }
}