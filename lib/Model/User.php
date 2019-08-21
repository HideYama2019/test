<?php

namespace MyApp\Model;

class User extends \MyApp\Model{
    public function create($values){
        $stmt=$this->db->prepare("insert into users (username,password,created,modified) value (:username,:password,now(),now())");
        $res=$stmt->execute([
            ':username'=>$values['username'],
            ':password'=>password_hash($values['password'],PASSWORD_DEFAULT)
        ]);
        if($res===false){
            throw new \MyApp\Exception\DuplicateUserName();
        }
    }
    public function login($values){
        $stmt=$this->db->prepare("select * from users where username=:username");
        $stmt->execute([
            'username'=>$values['username']
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
        $user=$stmt->fetch();

        if(empty($user) || !password_verify($values['password'],$user->password)){
            throw new \MyApp\Exception\UnmatchUserNameOrPassword();
        }

        return $user;
    }
    public function findAll(){
        $stmt=$this->db->query("select * from users order by id");
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
        return $stmt->fetchAll();
    }
}