<?php
namespace MyApp\Controller;

class Index extends \MyApp\Controller{
    public function run(){
        if(!$this->isLoggedIn()){
            header("Location:http://".$_SERVER['HTTP_HOST']."/login.php");
            exit;
        }
        $userModel= new \MyApp\Model\User();
        $this->setValue('users',$userModel->findAll());
    }
}