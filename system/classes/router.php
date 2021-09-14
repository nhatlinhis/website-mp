<?php

class router{
    //default folder controller, mothod, param
    private $controller = "homeControl";
    private $method = "index";
    private $params = [];
    public function __construct(){
        $url = $this->url();
        // print_r('<br>router.php<br>');
        // print_r($url);
        // print_r('<br>');
        if (!empty($url)) {
            if (file_exists("../application/controllers/" . $url[0] . "Control.php")) {
                $this->controller = $url[0].'Control';
                unset($url[0]);
            } else {
                echo '<div class="alert alert-danger text-center">
                <strong>Erorr: </strong> File not found: <em>' . $url[0] . 'Control.php</em></div>';
            }
        }
        //include controller
        require_once "../application/controllers/" . $this->controller .".php";
        //instantiate controller
        $this->controller = new $this->controller();
        //get method
        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                echo '<div class="alert alert-danger text-center">
                <strong>Erorr: </strong> Method not found: <em>' . $url[1] . '.php</em></div>';
            }
        }
        //get params
        if (isset($url)) {
            $this->params = $url;
        } else {
            $this->params = [];
        }
        //call method 
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function url()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url); //remove white space from the right side
            $url = filter_var($url, FILTER_SANITIZE_URL); //remove characters not valid
            $url = explode("/", $url); //break string to array by separator
            return $url;
        }
    }
}
?>