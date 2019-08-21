<?php
namespace MyApp\Controller;

class Login extends \MyApp\Controller{
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
        }catch(\MyApp\Exception\EmptyPost $e){
            $this->setError('login',$e->getMessage());
        }
        
        $this->setValue('username',$_POST['username']);
        
        if($this->hasError()){
            return;
        }else{
            //ユーザーを作成
            try{
                $userModel=new \MyApp\Model\User();
                $user=$userModel->login([
                    'username'=>$_POST['username'],
                    'password'=>$_POST['password']
                ]);   
            }catch(\MyApp\Exception\UnmatchUserNameOrPassword $e){
                $this->setError('login',$e->getMessage());
                return;
            }
            session_regenerate_id(true);
            $_SESSION['me']=$user;
            //ログイン画面にリダイレクト
            header("Location:http://".$_SERVER['HTTP_HOST']);
            exit;
        }
    }
    private function _validate(){
        if(!isset($_POST['token']) || $_SESSION['token']!==$_POST['token']){
            echo "Invalid Token!";
            exit;
        }
        if(!isset($_POST['username']) || !isset($_POST['password'])){
            echo "Invalid Form!";
            exit;
        }
        if($_POST['username']==="" || $_POST['password']===""){
            throw new \MyApp\Exception\EmptyPost();
        }
    }
}