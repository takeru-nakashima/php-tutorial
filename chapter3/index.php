<?php

require 'database.php';

// ユーザー入力なし query
$sql = 'select * from contacts where id = 2'; //sql
$stmt = $pdo->query($sql);
$result = $stmt->fetchall();

echo '<pre>';
echo var_dump($result);
echo '<pre>';


// ユーザー入力あり prepare, bind, execute 悪意ユーザ delete * SQLインジェクション
$sql = 'select * from contacts where id = :id';
$stmt = $pdo->prepare($sql); //プリペアードステートメント
$stmt->bindValue('id', 2, PDO::PARAM_INT);//紐付け
$stmt->execute();//実行

$result = $stmt->fetchall();
echo '<pre>';
echo var_dump($result);
echo '<pre>';

// トランザクション　まとまって処理 beginTransaction, commit, rollback
$pdo->beginTransaction();
try{
    $sql = 'select * from contacts where id = :id';
    $stmt = $pdo->prepare($sql); //プリペアードステートメント
    $stmt->bindValue('id', 2, PDO::PARAM_INT);//紐付け
    $stmt->execute();//実行

    $pdo->commit();

}catch(PDOException $e){
    $pdo->rollback(); //更新のキャンセル
}

?>