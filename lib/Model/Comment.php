<?php
namespace MyApp\Model;

class Comment extends \MyApp\Model{
    //allComment()でデータベース内のコメントを引っ張る
    public function allComment(){
        $stmt=$this->db->query('select * from comment order by id desc');
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
        return $stmt->fetchAll();
    }
    public function post_comment(){
        //コメントが送られてきた場合データベースに投稿されたコメントを保存
        $stmt=$this->db->prepare('insert into comment (username,comment,created) values(:name,:comment,now())');
        $res=$stmt->execute([
            //$_SESSION['me']には自分のユーザー情報がオブジェクト形式で保管
            ':name'=>$_SESSION['me']->username,
            ':comment'=>$_POST['comment']
        ]);
        if($res==='false'){
            echo 'コメントの投稿に失敗しました';
        }
    }
    public function delete(){
        //コメントを削除
        $stmt=$this->db->prepare('delete from comment where id=:id');
        $res=$stmt->execute([
            //comment-idを渡すことで削除したいコメントが何番のidのものか判断
            ':id'=>$_POST['comment-id']
        ]);
    //header('Location:http://'.$_SERVER['HTTP_HOST']);
    //exit;
    }
}