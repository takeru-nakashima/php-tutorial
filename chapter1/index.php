<?php
//phpのエラーブラウザ表示方法
// 1.php.iniに直接記述
// 2.ファイルに記述
ini_set('display_errors', 'ON');

//　書き方
echo('test');
echo('<br>'); //改行
echo('php');

//　変数
$test = 123;
echo $test;

var_dump($test);
echo '<br>';

// 定数
const MAX = 'テスト1';
const MAX = 'テスト2';

echo MAX;
echo '<br>';


// 配列
$array = [1,2,3];
echo $array; //配列の中身はecho出力では見れない。
echo '<br>';

echo '<pre>'; //横出力されるものを盾に出力してくれる。
var_dump($array);
echo '<pre>';

$array1 = [
    [0,1,2],
    [3,4,5]
];
// 2つ目の配列の中の3番目を取りたい場合
echo $array1[1][2];
echo '<br>';

// 連想配列 
$array_member = [
    'name' => 'ホンダ', //=>を使うことが少し慣れない。
    'height' => 170,
    'hobby' => 'サッカー'
];
echo $array_member['hobby'];
echo '<br>';

$array_member1 = [
    '1ikumi' => [
    'name' => 'ホンダ',
    'height' => 170,
    ],
    '2ikumi' => [
    'name' => 'カガワ', 
    'height' => 165,
    ],
];
echo $array_member1['2ikumi']['name'];
echo '<br>';

// phpの演算子
$test1 = 1;
$test2 = 2;

$test3 = $test1 + $test2;
echo $test3;

// if文, foreach
$height = 90;
if($height === 90){
    echo '身長は' + $height + 'cmです。' ; //出力結果： 90
    echo '身長は' . $height . 'cmです。' ; //出力結果： 身長は90cmです。　文字列連結は.でないとダメ。JSの癖で+で書くと変数の値だけ出力される。
}; // 綺麗な書き方：if文はelseをなるべく使用しない。if文を2つ書いた方が見やすくなる。

$test = ''; //空判定になる。
if(empty($test)){
    echo '変数はからです。';
};
echo '<br>';

$members = [
    'name' => '本田',
    'height' => 170,
    'hobby' => 'サッカー'
];
foreach($members as $member){
    echo $member;
};
echo '<br>';

foreach($members as $key => $value){
    echo $key . 'は' . $value;
};
echo '<br>';

$array_member1 = [
    '1ikumi' => [
    'name' => 'ホンダ',
    'height' => 170,
    ],
    '2ikumi' => [
    'name' => 'カガワ', 
    'height' => 165,
    ],
];
foreach($array_member1 as $array_member2){
    foreach($array_member2 as $member){
        echo $member;
    }
}
echo '<br>';

// phpのfor, while
for($i = 0; $i < 10; $i++){
    if($i === 5){
        break; // 5が来たらループを強制終了
        continue; // 5の時にスキップ
    }
    echo '<br>';
    echo $i;
}
echo '<br>';

// switch
//  phpのswitch注意点
// 1. breakを必ず入れないと処理が流れる。 2. caseが == で判定されている。
// なのでなるべくif文を使用した方が良い。

$data = 1;
switch($data){
    case 1:
        echo '1です';
        break;
    case 2:
        echo '2です';
        break;
    case 3:
        echo '3です';
        break;
    default:
     echo '1-3ではありません。';
}

//　関数　１.ユーザー定義関数　2.組み込み関数
function test(){
    return ;
}
echo '<br>';

$text = 'abc';
echo strlen($text);

$text = 'あいうえお';
echo mb_strlen($text);

//文字列の置換
$str = '文字列を置換します。';
echo str_replace('置換', 'ちかん', $str);

//指定文字列で分割
$str_2 = '指定文字列で、分割します。';
echo var_dump(explode('、', $str_2));

//正規表現
$str_3 = '特定の文字列が含まれるか確認する';
echo preg_match('/文字列/', $str_3);

//指定文字列から文字列を取得する。
echo substr('あいうえお', 2);
echo '<br>';
echo mb_substr('あいうえお', 2);

// https://www.php.net/manual/ja/funcref.php

// 配列の関数
// 配列に配列を追加する。
$array = ['りんご', 'みかん'];
array_push($array, 'ぶどう', 'なし');
echo '<pre>';
echo var_dump($array);
echo '<pre>';

// http://html2php.starrypages.net/php/array-funcs


// 関数を自作してみる。
$postalCode = '123-4567';

function checkPostalCode($str){
    $replaced = str_replace('-', '', $str);
    $length = strlen($replaced);

    if($length === 7){
        return true;
    }
    return false;
}
var_dump(checkPostalCode($postalCode));

// 変数のスコープ
$globalVariables = 'グローバル変数です。';

function checkScope() {
    $localVariables = 'ローカル変数です。';
    echo $localVariables;
    echo $globalVariables; //  これは使えない。JSと違う点
}
function checkScope1($str) {
    $localVariables = 'ローカル変数です。';
    echo $localVariables;
    echo $str; //  これは使える。
}

checkScope();
echo '<br>';
checkScope1($globalVariables);
echo '<br>';

//ファイルの読み込み
// require
// include

// require 'common.php';
require __DIR__ . '/common.php';
echo $commonVariables;
commonTest();

// マジック定数
echo __DIR__; //絶対参照
echo __FILE__; //__DIR__　+ ファイル
echo phpinfo();
?>


<!-- 
    メモ
    phpは必ず;が必要
    htmlタグは''で囲む必要がある
    定数は大文字で書くことが多い
    phpは$をよく入力するがキーボードでは少し打ちにくい。

    phpのdisplay_erros　エラーではないが出力されるもの
    1. var_dump($array)で配列が文字列に置き換わる
    2. constで同じ値を置くと出る。
    3. グローバル変数を直接、関数の中で参照すると警告がでる。
 -->