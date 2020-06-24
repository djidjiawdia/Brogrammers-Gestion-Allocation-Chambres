<?php

class ErreurCtrl extends Controller {

    public function showError($errorMess){
        die($errorMess);
    }
    
}