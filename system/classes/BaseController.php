<?php

class BaseController{
    public function view($folder, $viewName, $data = []){
        if(file_exists("../application/views/".$folder."/".$viewName.".php")){
            require_once "../application/views/".$folder."/".$viewName.".php";
        } else {
            echo '<div class="alert alert-danger text-center">
                <strong>Erorr: </strong> File not found: <em>' . "file not found: ".$viewName.".php"
                 . 'Control.php</em></div>';
        }
    }

    public function model($modelName){
        if(file_exists("../application/models/".$modelName.".php")){
            require_once "../application/models/".$modelName.".php";
            return new $modelName;
        } else {
            echo '<div class="alert alert-danger text-center">
                <strong>Erorr: </strong> File not found: <em>' . "file not found: ".$modelName.".php"
                 . 'Control.php</em></div>';
        }
    }
    public function input($inputName){
        if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == 'post'){
            return $_POST[$inputName];
        } else if($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'get'){
            return $_GET[$inputName];
        }
    }
    // Set session
   public function setSession($sessionName, $sessionValue){
        if(isset($sessionName) && isset($sessionValue)){
            $_SESSION[$sessionName] = $sessionValue;
        }
    }

    // Get session
    public function getSession($sessionName){
        if(isset($_SESSION[$sessionName])){
            return $_SESSION[$sessionName];
        }
    }
    // Unset session
    public function unsetSession($sessionName){
        if(isset($sessionName)){
            unset($_SESSION[$sessionName]);
        }
    }
    // Destroy whole sessions
    public function destroy(){
        session_destroy();
    }
    
    public function redirect($path){
        header("location:" . BASEURL . "/".$path);
    }

    public function getImg(){
        $userModel = $this->model('userModel');
        if($this->getSession('Account')){
            return $userModel->getImg($this->getSession('Account'))->img;
        }
        return null;
    }
    
    public function formatPrice($price){
        $r = "";
        $c = 0;
        for($i=strlen($price)-1; $i>=0; $i--){
            if($c%3==0 && $c!=0){
                $r.=",";
            }
            $r.=$price[$i];
            $c++;
        }
        return strrev($r);
    }
}