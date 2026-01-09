<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規登録画面</title>
</head>

<body>
    <h1>新規投稿</h1>
  
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" class="form-control">
        </div> 
        <div class="form-group">
            <label for="content">内容:</label><br>
            <textarea name="content" id="content" rows="5" cols="40"></textarea>
        </div>
        <div class="form-group">
            <label for="image">画像:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">投稿</button>

    </form>
</body>
</html>