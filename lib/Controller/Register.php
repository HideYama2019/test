<?php
namespace MyApp\Controller;

class Register extends \MyApp\Controller{
    public function run(){
        if($this->isLoggedIn()){
            header("Location:http://".$_SERVER['HTTP_HOST']);
            exit;
        }
        if($_SERVER["REQUEST_METHOD"]==='POST'){
            $this->postProcess();
        }
    }
    protected function postProcess(){
        //妥当か検証
        try{
            $this->_validate();
        }catch(\MyApp\Exception\InvalidUserName $e){
            $this->setError('username',$e->getMessage());
        }catch(\MyApp\Exception\InvalidPassword $e){
            $this->setError('password',$e->getMessage());
        }
        
        $this->setValue('username',$_POST['username']);
        
        if($this->hasError()){
            return;
        }else{
            //ユーザーを作成
            try{
                $userModel=new \MyApp\Model\User();
                $userModel->create([
                    'username'=>$_POST['username'],
                    'password'=>$_POST['password']
                ]);   
            }catch(\MyApp\Exception\DuplicateUserName $e){
                $this->setError('username',$e->getMessage());
                return;
            }
            //ログイン画面にリダイレクト
            header("Location:http://".$_SERVER['HTTP_HOST']."/login.php");
            exit;
        }
    }
    private function _validate(){
        if(!isset($_POST['token']) || $_SESSION['token']!==$_POST['token']){
            echo "Invalid Token!";
        }
        if(!preg_match("/\A[a-zA-Z0-9]+\z/",$_POST['username'])){
            throw new \MyApp\Exception\InvalidUserName();
        }elseif(!preg_match("/\A[a-zA-Z0-9]+\z/",$_POST['password'])){
            throw new \MyApp\Exception\InvalidPassword();
        }
    }
}