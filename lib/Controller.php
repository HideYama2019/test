<?php
namespace MyApp;
class Controller{
    private $_values;
    private $_errors;
    public function __construct(){
        if(!isset($_SESSION['token'])){
            $_SESSION['token']=bin2hex(openssl_random_pseudo_bytes(16));
        }
        $this->_errors=new \stdClass();
        $this->_values=new \stdClass();
    }
    protected function setValue($key,$value){
        $this->_values->$key=$value;
    }
    public function getValue(){
        return $this->_values;
    }
    protected function setError($key,$error){
        $this->_errors->$key=$error;
    }
    public function getError($key){
        return isset($this->_errors->$key) ?  $this->_errors->$key : '';
    }
    protected function hasError(){
        return !empty(get_object_vars($this->_errors));
    }
    protected function isLoggedIn(){
        return isset($_SESSION['me']) && !empty($_SESSION['me']);
    }
    public function me(){
        return $this->isLoggedIn() ? $_SESSION['me'] : null;
    }
}