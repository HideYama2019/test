<?php
require_once(__DIR__."/../config/config.php");
$app=new \MyApp\Controller\Login();
$app->run();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザーログイン</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="container">
        <h1>ログインしてコメントを投稿しよう</h1>
        <form action="" method="post">
            <input class="text-box" type="text" name="username" placeholder="ユーザー名(半角英数字)" value="<?=isset($app->getValue()->username) ? h($app->getValue()->username):'';?>"><br>
            <input class="text-box" type="password" name="password" placeholder="パスワード"><br>
            <p class="err"><?=h($app->getError('login'));?></p>
            <div class="btn-top">
                <input class="btn btn-sub" type="submit" value="ログイン">
            </div>
            <div class="btn-bottom">
                <input class="btn btn-res" type="reset" value="クリア">
            </div>
            <input type="hidden" name='token' value="<?=h($_SESSION['token'])?>">
            </form>
            <a href="/register.php">新規登録はこちら</a>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" async></script>
<script async>
    
</script>
</body>
</html>