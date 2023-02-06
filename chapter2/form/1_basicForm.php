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
$pageFlag = 0;
if(!empty($_POST['btn_confirm'])){
    $pageFlag = 1;
}
if(!empty($_POST['btn_submit'])){
    $pageFlag = 2;
}

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
    <!-- 入力画面 -->
    <?php if($pageFlag === 0): ?>
    <form action="basicForm.php" method="POST">
    氏名
    <input type="text" name="your_name" id="" value="<?php if(!empty($_POST['your_name'])){echo $_POST['your_name'];} ?>">
    <br>
    メールアドレス
    <input type="email" name="email" id="" value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} ?>">
    <br>

    <input type="submit" name="btn_confirm" value="確認する">
    </form>
    <?php endif; ?>

    <!-- 確認画面 -->
    <?php if($pageFlag === 1): ?>
    <form action="basicForm.php" method="POST">
    氏名
    <?php echo $_POST['your_name']; ?>
    <br>
    メールアドレス
    <?php echo $_POST['email']; ?>
    <br>

    <input type="submit" name="back" value="戻る">
    <input type="submit" name="btn_submit" value="送信">
    <input type="hidden" name="your_name" value="<?php echo $_POST["your_name"] ?>" >
    <input type="hidden" name="email" value="<?php echo $_POST["email"] ?>" >

    </form>
    <?php endif; ?>

    <!-- 完了画面 -->
    <?php if($pageFlag === 2): ?>
        送信が完了しました。
    <?php endif; ?>


</body>
</html>

<!-- メモ
   hiddenは$_POSTの値を保持したい時
   基礎的なフォームの作成方法（送信ボタンのnameが鍵)
   1. 入力、確認、完了の3画面を用意する。
   2. それぞれ切り替えflagを持たせる。切り替えフラグはinput:submitのnameで判断する。
   3. 戻るボタンも送信ボタンのnameで判断させる。その際に値を保持させる場合には確認画面のデフォルトvalueにhiddenで取得した値を取得させる。
-->