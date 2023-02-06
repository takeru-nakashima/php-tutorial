<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['visited'])){
        echo '初回訪問です';

        $_SESSION['visited'] = 1;
        $_SESSION['date'] = date('c');
    } else{

        $visited = $_SESSION['visited'];
        $visited++;
        $_SESSION['visited'] = $visited;
        echo '前回訪問は'. $_SESSION['visited'].'回目の訪問です<br>';

        if(isset($_SESSION['date'])){
            echo '前回訪問は'.$_SESSION['date'].'です';
        }
    }
    echo '<pre>';
    echo var_dump($_SESSION);
    echo '<pre>';

    echo '<pre>';
    echo var_dump($_COOKIE);
    echo '<pre>';


    ?>

</body>
</html>


<!-- クッキーとセッションメモ
    セッションはサーバー
    クッキーはブラウザにある。
    特徴：値を保持する。

    参考：https://tadworks.jp/archives/1147
    セッションとクッキーでログイン機能実装

    session_start();
    セッション、クッキーが作成される。

    session_destroy();
    セッションが削除される。
    クッキーは空で上書きする形で削除する。
-->