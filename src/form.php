<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力フォーム</title>
    <link rel="stylesheet" href="style.css?v=1">
</head>
<body>
<div class="container">  
 <h1>入力フォーム</h1>
 <form action="confirm.php" method="post">
 <div class="form-group">
    <label for="username">名前:</label>
    <input type="text" id="username" name="username">
</div>

<div class="form-group">
  <label for="age">年齢:</label>
    <input type="number" id="age" name="age">
</div>

<div class="form-group">
    <label for="tel">電話番号:</label>
    <input type="tel" id="tel" name="tel">
</div>

<div class="form-group">
    <label for="email">メールアドレス:</label>
    <input type="email" id="email" name="email">
</div>

<div class="form-group">
    <label for="address">住所:</label>
    <input type="text" id="address" name="address">
</div>

<div class="form-group">
    <label for="question">ご質問:</label>
    <textarea id="question" name="question" rows="4"></textarea>
</div>

<div class="form-group">
    <label for="gender">性別:</label>
    <select id="gender" name="gender">
        <option value="male">男性</option>
        <option value="female">女性</option>
    </select>
</div>

<br><br>
    <button type="submit">送信</button>

</form>
</body>
</html>
    
