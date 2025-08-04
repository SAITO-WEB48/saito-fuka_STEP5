<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
    <link rel="stylesheet" href="style.css?v=1">
</head>
<body>
 <h1>入力内容確認</h1>
<?php
$allowed_genders =[
    "male" => "男性",
    "female" => "女性",
    "other" => "その他"
];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username= $_POST["username"];
    $age= $_POST["age"];
    $tel= $_POST["tel"];
    $email= $_POST["email"];
    $address= $_POST["address"];
    $question= $_POST["question"];
    $gender= $_POST["gender"];


//バリデーション
if (!preg_match("/^[あ-んア-ヶー一-龠a-zA-Z\s]+$/u", $username)) {
    echo"<p>名前はひらがな、カタカナ、漢字、英字のみで入力してください。</p>";
}elseif(!is_numeric($age) || $age < 0 || $age > 150){
    echo"<p>年齢は0から150の間で入力してください。</p>";
}elseif(!preg_match("/^\d{2,4}-\d{2,4}-\d{4}$/", $tel)) {
    echo "<p>電話番号は半角数字とハイフンのみで入力してください。</p>";
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p>メールアドレスの形式が正しくありません。</p>";
}elseif(!preg_match("/^[あ-んア-ヶー一-龠a-zA-Z\s]+$/u", $address)) {
    echo"<p>住所はひらがな、カタカナ、漢字、英字のみで入力してください。</p>";
}else{

    
//入力内容の表示
    echo"<p>名前:".htmlspecialchars($username,ENT_QUOTES,'UTF-8')."</p>";
    echo"<p>年齢: {$age}歳</p>";
    echo"<p>電話番号:{$tel}</p>";
    echo"<p>メールアドレス:".htmlspecialchars($email,ENT_QUOTES,'UTF-8')."</p>";
    echo"<p>住所:".htmlspecialchars($address,ENT_QUOTES,'UTF-8')."</p>";
    echo"<p>質問:" . nl2br(htmlspecialchars($question,ENT_QUOTES,'UTF-8'))."</p>";
    echo"<p>性別: {$allowed_genders[$gender]}</p>";
}
}else{
    echo"<p>データが送信されません。</p>";
}
?>
</body>
</html>


    


