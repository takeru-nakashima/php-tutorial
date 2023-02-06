<?php

// 引数に初期値を入れる。
function ($test = 'テスト'){
    echo $test;
};

// 引数に型をつける。
function typeTest(string $string){
    echo $string;
};

// ...
function test(...$names){
    // echo 
};

// 返り値に型
function test1(string $string): string {
    // echo
};

// コールバック関数
$trimParameters = array_map('trim', $array);

// メソッドチェーン
$price = $cart->getItem(0)->getPrice();

?>





<!-- phpの返り値は
    echo or returnどちらを使うのか？
-->