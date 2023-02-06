<?php
// パスワードを記録したファイルの場所
echo __FILE__;
///Applications/MAMP/htdocs/php-tutorial/chapter2/mainte/test.php

// パスワード（暗号化）
echo '<br>';
echo(password_hash('password123', PASSWORD_BCRYPT));

?>

<!-- ベーシック認証　メモ
1. .htaccessにパスワードの場所を書く
2. ユーザー名、暗号化されたパスワードを置く。
-->