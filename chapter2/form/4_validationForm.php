<?php
header('X-FRAME-OPTIONS:DENY');

require __DIR__ . '/validation.php';
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
$errors = validation($_POST);
if(!empty($_POST['btn_confirm']) && empty($errors)){
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

    <?php if(!empty($errors) && !empty($_POST['btn_confirm'])): ?>
       <?php echo '<ul>' ?>
       <?php foreach($errors as $error) : ?>
        <?php echo '<li>'. $error . '</li>' ?>
        <?php endforeach; ?>
       <?php echo '<ul>' ?>
    <?php endif; ?>

    <form action="validationForm.php" method="POST">
    氏名
    <input type="text" name="your_name" id="" value="<?php if(!empty($_POST['your_name'])){echo h($_POST['your_name']);} ?>">
    <br>
    メールアドレス
    <input type="email" name="email" id="" value="<?php if(!empty($_POST['email'])){echo h($_POST['email']);} ?>">
    <br>
    ホームページ
    <input type="url" name="url" id="" value="<?php if(!empty($_POST['url'])){echo h($_POST['url']);} ?>">
    <br>
    性別
    <input type="radio" name="gender" value="0" 
    <?php 
        if(isset($_POST['gender']) && $_POST['gender'] === '0'){
            echo 'checked';
        }
    ?>
     id="">男性
    <input type="radio" name="gender" value="1" 
    <?php 
        if(isset($_POST['gender']) && $_POST['gender'] === '1'){
            echo 'checked';
        }
    ?> id="">女性
    <br>
    年齢
    <select name="age">
        <option value="">選択してください</option>
        <option value="1">~19歳</option>
        <option value="2">20~29</option>
        <option value="3">30~39</option>
        <option value="4">40~49</option>
        <option value="5">50~59</option>
        <option value="6">60~</option>
    </select>
    <br>
    お問い合わせ内容
    <textarea name="contact">
    <?php if(!empty($_POST['contact'])){echo h($_POST['contact']);} ?>
    </textarea>
    <br>
    <input type="checkbox" name="caution" value="1" id=""> 注意事項にチェックする
    <br>

    <input type="submit" name="btn_confirm" value="確認する">
    <input type="hidden" name="csrf" value="<?php echo $token ?>">
    </form>
    <?php endif; ?>

    <!-- 確認画面 -->
    <?php if($pageFlag === 1): ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
    <form action="validationForm.php" method="POST">
    氏名
    <?php echo h($_POST['your_name']); ?>
    <br>
    メールアドレス
    <?php echo h($_POST['email']); ?>
    <br>
    ホームページ
    <?php echo h($_POST['url']); ?>
    <br>
    性別
    <?php
    if($_POST['gender'] === '0'){echo '男性';}
    if($_POST['gender'] === '1'){echo '女性';}
    ?>
    <br>
    年齢
    <?php
    if($_POST['age'] === '1'){echo '~19歳';}
    if($_POST['age'] === '2'){echo '~29歳';}
    if($_POST['age'] === '3'){echo '~39歳';}
    if($_POST['age'] === '4'){echo '~49歳';}
    if($_POST['age'] === '5'){echo '~59歳';}
    if($_POST['age'] === '6'){echo '~69歳';}
    ?>
    <br>
    お問い合わせ内容
    <?php echo h($_POST['contact']); ?>
    <br>

    <input type="submit" name="back" value="戻る">
    <input type="submit" name="btn_submit" value="送信">
    <input type="hidden" name="your_name" value="<?php echo h($_POST["your_name"]) ?>" >
    <input type="hidden" name="email" value="<?php echo h($_POST["email"]) ?>" >
    <input type="hidden" name="url" value="<?php echo h($_POST["url"]) ?>" >
    <input type="hidden" name="gender" value="<?php echo h($_POST["gender"]) ?>" >
    <input type="hidden" name="age" value="<?php echo h($_POST["age"]) ?>" >
    <input type="hidden" name="contact" value="<?php echo h($_POST["contact"]) ?>" >

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

<!-- メモ　バリデーション
    0.エラーの値を格納するファンクション作成
    ファンクションの中身
    POSTの連想配列をエラーを格納する関数の引数に使用。
    値が入ってなければエラー値を返すファンクション作成
    
    1. エラーがあれば画面遷移をさせない。
    2. エラーがあれば画面にエラー内容を表示させる。
-->