<?php

### ファイルの値取得、追加
$contactFile = '.contact.dat';

$fileContents = file_get_contents($contactFile);
echo $fileContents;

// ファイルに書き込み（上書き）
file_put_contents($contactFile, 'テストです');

// ファイルに書き込み（追記）
$addText = 'テストです。'. "\n";
file_put_contents($contactFile, $addText, FILE_APPEND);


### CSVファイル
// 配列 区切るexplode, foreach使用でCSVファイル形式出力する。
$csvFile = 'csv.dat';
$allData = file($csvFile);

foreach($allData as $lineData){
    $lines = explode(',',$lineData);
    echo $lines[0]. '<br>';
    echo $lines[1]. '<br>';
    echo $lines[2]. '<br>';
}
?>