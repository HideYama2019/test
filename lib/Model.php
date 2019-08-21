<?php

namespace MyApp;

class Model{
    protected $db;
    public function __construct(){
        try{
            //PDOでデータベースに接続、引数はconfig.phpで設定した定数
            //DSN='mysql:dbhost=localhost;dbname=myportforio'
            //$dbはオブジェクト
            $this->db=new \PDO(DSN,DB_USER,DB_PASSWORD);    
        }catch(\PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }

}
