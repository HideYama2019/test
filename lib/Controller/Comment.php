<?php
namespace MyApp\Controller;

class Comment extends \MyApp\Controller{
    public function getComment(){
        $comments=new \MyApp\Model\Comment();
        //$commentsをオブジェクト形式で返す
        return $comments->allComment();
    }
    public function delComment(){
        //データベース処理は名前空間Modelで行うためそちらを呼び出す
        $delComments=new \MyApp\Model\Comment();
        $delComments->delete();
        //header('Location:http://'.$_SERVER['HTTP_HOST']);
        //exit;
    }
}