<?php
require_once(__DIR__."/../config/config.php");
$app=new MyApp\Controller\Index();
$app->run();
$comment=new MyApp\Controller\Comment();
//var_dump($app->getValue()->users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <header>
        <div class="header-left">
            <p>ログイン中のユーザー：<?=h($_SESSION['me']->username);?></p>
        </div>
        <div class="header-right">
            <form action="logout.php" method="post">
                <input class="logout" type="submit" value="ログアウト">
                <input type="hidden" name='token' value="<?=h($_SESSION['token'])?>">
            </form>
        </div>
    </header>
    <div class="main">
        <div class="container-all">
            <div class="container-left">
                <p>ユーザー一覧</p>
                <ul>
                    <?php foreach($app->getValue()->users as $user) :?>
                    <li>〇<?=h($user->username);?></li>
                    <?php endforeach;?>
                </ul>
            </div>    
            <div class="container-main">
                <h2>掲示板</h2>
                <form action="post_comment.php" method="post">
                    <input type="hidden" name='token' value="<?=h($_SESSION['token'])?>">
                    <p><textarea name="comment"></textarea></p>
                    <input class="btn btn-sub" type="submit" value='送信'>
                    <input class="btn btn-reset" type="reset" value="リセット">
                </form>
                <div class="comments">
                    <?php foreach($comment->getComment() as $cmt) :?>
                        <div class="comment-dis">
                            <p class="comment-user">
                                <?=h($cmt->id).'.　'.h($cmt->username) . '　　　'.h($cmt->created);?>
                                <?php if($cmt->username===$_SESSION['me']->username):?>
                                <form action="delete.php" method="post">
                                    <input class="btn btn-del" type="submit" value="削除">
                                    <input type="hidden" value="<?=h($cmt->id);?>" name="comment-id">
                                </form>
                                <?php endif;?>
                            </p>
                        </div>                    
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(function(){
            "use strict";
            function resComment(){
                    $('#res-com').on('click',function(){
                    if($(this).hasClass('response')){
                        $(this).siblings().remove();
                        $(this).removeClass('response');
                    }else{
                        $(this).parent().append("<br><textarea></textarea></br><input type='submit' value='送信'>");
                        $(this).addClass("response");
                    }
                });    
            };
        });
    </script>
</body>
</html>