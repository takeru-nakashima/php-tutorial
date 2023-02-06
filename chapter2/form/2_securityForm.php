<?php
header('X-FRAME-OPTIONS:DENY');
session_start();

// if(!empty($_POST)){
//     echo '<pre>';
//     echo var_dump($_POST);
//     echo '<pre>';
// }

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


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
    <?php 
    if(!isset($_SESSION['csrfToken'])){
        $csrcToken = bin2hex(random_bytes(32));
        $_SESSION['csrfToken'] = $csrcToken;
    }
    $token = $_SESSION['csrfToken'];
    ?>

    <form action="securityForm.php" method="POST">
    氏名
    <input type="text" name="your_name" id="" value="<?php if(!empty($_POST['your_name'])){echo h($_POST['your_name']);} ?>">
    <br>
    メールアドレス
    <input type="email" name="email" id="" value="<?php if(!empty($_POST['email'])){echo h($_POST['email']);} ?>">
    <br>
    <input type="submit" name="btn_confirm" value="確認する">
    <input type="hidden" name="csrf" value="<?php echo $token ?>">
    </form>
    <?php endif; ?>

    <!-- 確認画面 -->
    <?php if($pageFlag === 1): ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
    <form action="securityForm.php" method="POST">
    氏名
    <?php echo h($_POST['your_name']); ?>
    <br>
    メールアドレス
    <?php echo h($_POST['email']); ?>
    <br>

    <input type="submit" name="back" value="戻る">
    <input type="submit" name="btn_submit" value="送信">
    <input type="hidden" name="your_name" value="<?php echo h($_POST["your_name"]) ?>" >
    <input type="hidden" name="email" value="<?php echo h($_POST["email"]) ?>" >
    <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ?>">
    </form>
    <?php endif; ?>
    <?php endif; ?>

    <!-- 完了画面 -->
    <?php if($pageFlag === 2): ?>
        <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
        送信が完了しました。

        <?php unset($_SESSION['csrf']) ?>
        <?php endif; ?>
    <?php endif; ?>


</body>
</html>

<!-- メモ　セキュリティ
・XSS クロスサイトスクリプティング
対処法：JSのalertなどをフォームの中でhtmlの文字列として認識させる
　　　　htmlSpecialCharsを使用 
ex, <script>alert('攻撃されますよ！')</script>

・クリックジャッキング
対処法：header('X-FRAME-OPTIONS:DENY');
phpの上部に記述するとhttp通信のヘッダーに追記される。
詳しくはわからないが透明でわかりにくいようなボタンをクリックさせて悪意のあるページに誘導したりすることをheader('X-FRAME-OPTIONS:DENY')記述で防ぐことができるようになる。

・CSRF Fは偽造という意味
偽物のinput
正しいformから来たということを判定し、正常なフォームから来たか確認する。
対処法：$_SESSION[], $_POST[]で暗号化されたものを比較する。
実装手順
入力：$_SESSIONにcsrfTokenを格納する。hiddenタグに作成したcsrfTokenを設定する。
確認：hiddenタグのcsrfTokenをPOSTで受け取り、グローバルの$_SESSIONの中のcsrfTokenと比較する。
完了：hiddenタグのcsrfTokenをPOSTで受け取り、グローバルの$_SESSIONの中のcsrfTokenと比較する。セッション終了する。
一言で表すなら、最初にセッショントークンを作成する。hiddenタグで投げた値をPOST受け取りセッショントークンと比較する。


-->