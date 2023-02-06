<?php

// スーパーグローバル変数 php 9種類
// 連想配列
// if(!empty($_GET['your_name'])){
//     echo $_GET['your_name'];
// }
if(!empty($_POST)){
    echo '<pre>';
    echo var_dump($_POST);
    echo '<pre>';
}

//入力、確認、完了　input.php, confirm.php, thanks.php
// input.phpの中で変数とif文で今回は作成する。

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
    <form action="input.php" method="POST">
    氏名
    <input type="text" name="your_name" id=""> <!-- nameがキーになる。 -->
    <br>
    <input type="checkbox" name="sports[]" value="野球" id="">野球 <!-- 複数あるものはsports[]のように配列形式で書く -->
    <input type="checkbox" name="sports[]" value="サッカー" id="">サッカー
    <input type="checkbox" name="sports[]" value="バスケ" id="">バスケ
    <input type="submit" value="送信">
    </form>
</body>
</html>

<!-- 続きは35から -->