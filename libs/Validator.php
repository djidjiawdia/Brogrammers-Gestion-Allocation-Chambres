<?php

class Validator{
   private $errors = [];

    public function getErrors(){
        return $this->errors;
    }

    public function isValid(){
        return count($this->errors) == 0;
    }


    public function isVide($champ, $key, $sms="Champ Obligatoire"){
        if($champ == ""){
            $this->errors[$key] = $sms;
        }
    }
    
    public function validWithRegex($champ, $regex, $key, $sms="L'email est incorrect"){
        if(!preg_match($regex, $champ)) {
            $this->errors[$key] = $sms;
        }
    }

    // number "/(7[7860])+([0-9]{7})$/"
    // email "/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/"
    // prenom [a-zA-Z ]*$
}