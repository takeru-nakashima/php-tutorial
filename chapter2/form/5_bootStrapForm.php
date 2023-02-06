<?php
header('X-FRAME-OPTIONS:DENY');

require __DIR__ . '/validation.php';
session_start();

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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
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

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="5_bootStrapForm.php" method="POST">
                <div class="form-group">
                    <label for="your_name">氏名</label>
                    <input type="text" name="your_name" class="form-control" id="your_name" value="<?php if(!empty($_POST['your_name'])){echo h($_POST['your_name']);} ?>">
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php if(!empty($_POST['email'])){echo h($_POST['email']);} ?>">
                </div>
                <div class="form-group">
                    <label for="url">ホームページ</label>
                    <input type="url" name="url" class="form-control" id="url" value="<?php if(!empty($_POST['url'])){echo h($_POST['url']);} ?>">
                </div>
             
                性別
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" class="form-check-input" value="0" <?php if(isset($_POST['gender']) && $_POST['gender'] === '0'){echo 'checked';}?>id="gender1">
                    <label for="form-check-label" for="gender1">男性</label>
                    <input type="radio" name="gender" value="1" <?php if(isset($_POST['gender']) && $_POST['gender'] === '1'){echo 'checked';}?>id="gender2">
                    <label for="form-check-label" for="gender2">女性</label>
                </div>

                <div class="form-group">
                    <label for="age">年齢</label>
                    <select name="age" class="form-control" id="age">
                        <option value="">選択してください</option>
                        <option value="1">~19歳</option>
                        <option value="2">20~29</option>
                        <option value="3">30~39</option>
                        <option value="4">40~49</option>
                        <option value="5">50~59</option>
                        <option value="6">60~</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contact">お問い合せ内容</label>
                    <textarea name="contact" class="form-control" id="contact" row="3">
                        <?php if(!empty($_POST['contact'])){echo h($_POST['contact']);} ?>
                    </textarea>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" name="caution" class="form-check-input" value="1" id="caution"> 
                    <label for="caution">注意事項にチェックする</label>
                </div>
                
                <input type="submit" name="btn_confirm" value="確認する" class="btn btn-info">
                <input type="hidden" name="csrf" value="<?php echo $token ?>">
            </form>
         </div>
      </div>
    </div>
<?php endif; ?>

<!-- 確認画面 -->
    <?php if($pageFlag === 1): ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
    <form action="5_bootStrapForm.php" method="POST">
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


   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

