<?php

function validation($request){//$_POSTの連想配列

    $errors = [];
    
    if(empty($request['your_name']) || 20 < mb_strlen($request['your_name']) ){
        $errors[] = '氏名は必須です.20文字以内で入力してください。';
    }
    if(empty($request['email']) || !filter_var($request['email'],FILTER_VALIDATE_EMAIl)){
        $errors[] = 'メールアドレスは必須です。正しい形式で入力してください';
    }
    if(!empty($request['url'])){
        if(!filter_var($request['url'], FILTER_VALIDATE_URL)){
            $errors[] = 'U正しい形式で入力してください';
        }
    }
    if(empty($request['contact']) || 200 < mb_strlen($request['contact']) ){
        $errors[] = 'お問い合せ内容は必須です。200文字以内で入力してください。';
    }
    if(!isset($request['gender'])){
        $errors[] = '性別は必須です。';
    }
    if(empty($request['age']) || 6 < $request['age']){
        $errors[] = '年齢は必須です。';
    }
    if(empty($request['caution']) || 20 < mb_strlen($request['caution']) ){
        $errors[] = '注意事項をご確認ください。';
    }
    return $errors;

} 

?>

<!-- メモ
値が入力されていなければ$errorsに値を入れる。

-->