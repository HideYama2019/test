<?php
require_once(__DIR__.'/../config/config.php');

if(isset($_POST['comment-id'])){
    $delCom=new \MyApp\Controller\Comment();
    $delCom->delComment();
}
header('Location:http://'.$_SERVER['HTTP_HOST']);