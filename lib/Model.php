<?php

namespace MyApp;

class Model{
    protected $db;
    public function __construct(){
        try{
            $this->db=new \PDO(DSN,DB_USER,DB_PASSWORD);    
        }catch(\PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }

}
