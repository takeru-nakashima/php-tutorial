<?php

// DB接続　PDO
function insertContact($request){

require 'database.php';

// 入力　prepare, execute(配列（全て文字列)
$params = [
    'id' => null,
    'your_name' => $request['your_name'],
    'email' => $request['email'],
    'url' => $request['url'],
    'gender' => $request['gender'],
    'age' => $request['age'],
    'contact' => $request['contact'],
    'created_at' => null
];
// $params = [
//     'id' => null,
//     'your_name' => 'なまえ',
//     'email' => 'test@test.com',
//     'url' => 'http://test.com',
//     'gender' => '1',
//     'age' => '2',
//     'contact' => 'いいい',
//     'created_at' => null
// ];

$count = 0;
$columns = '';
$values = '';

foreach(array_keys($params) as $key){
    if($count ++>0){
        $columns .= ',';
        $values .= ',';
    }
    $columns .= $key;
    $values .= ':'.$key;
}

$sql = 'insert into contacts ('. $columns .')values('. $values .')' ;
var_dump($sql);
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

}

?>

<!-- DBメモ
1. DB接続はPDOで接続する。
2. sql, prepare bind executeの2つの方法がある。
3, insert into テーブル名 カラム　values 値
カラムを,区切りで長い文字列として配列を組み替える。 valuesも同じ。
4, トランザクションはbeginTrasactionで始める。pdoが元々用意している関数を使用できる。
-->