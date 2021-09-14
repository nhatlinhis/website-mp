<?php

class database{
    private $con;
    private $result;

    public function __construct(){
        try{
            $this->con = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
        } catch(PDOException $e){
            echo '<div class="alert alert-danger text-center">
                <strong>Erorr: </strong> File not found: <em>'. 
                $e->getMessage() . 'Control.php</em></div>';
        }
    }

    public function Query($query, $pargams = []){
        
        try {
            if(empty($pargams)){
                $this->result = $this->con->prepare($query);
                return $this->result->execute();
            } else {
                $this->result = $this->con->prepare($query);
                //return true or false
                //after excute result will be table or PDOException
                return $this->result->execute($pargams);
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger text-center">
                <strong>Erorr: </strong> File not found: <em>'. 
                $e->getMessage().'Control.php</em></div>';
        }
    }

    public function startTran(){
        $this->Query('SET AUTOCOMMIT=0');
        $this->Query('START TRANSACTION');
    }

    public function commit(){
        $this->Query('COMMIT');
    }

    public function rollback(){
        $this->Query('ROLLBACK');
    }

    public function rowCount(){
        return $this->result->rowCount();
    }

    public function fetchAll(){
        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetch(){
        return $this->result->fetch(PDO::FETCH_OBJ);
    }
}


?>