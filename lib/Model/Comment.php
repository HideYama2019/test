<?php
namespace MyApp\Model;

class Comment extends \MyApp\Model{
    public function allComment(){
        $stmt=$this->db->query('select * from comment order by id desc');
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
        return $stmt->fetchAll();
    }
    public function post_comment(){
        $stmt=$this->db->prepare('insert into comment (username,comment,created) values(:name,:comment,now())');
        $res=$stmt->execute([
            ':name'=>$_SESSION['me']->username,
            ':comment'=>$_POST['comment']
        ]);
        if($res==='false'){
            echo 'コメントの投稿に失敗しました';
        }
    }
    public function delete(){
        $stmt=$this->db->prepare('delete from comment where id=:id');
        $res=$stmt->execute([
            ':id'=>$_POST['comment-id']
        ]);
    //header('Location:http://'.$_SERVER['HTTP_HOST']);
    //exit;
    }
}