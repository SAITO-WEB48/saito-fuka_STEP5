@extends('app')

@section('title', 'ブログ編集')

@section('content')
<div class="container">
    <h1>ブログを編集</h1>

    {{-- バリデーションエラーメッセージの表示 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ブログ編集フォーム --}}
    <form action="{{ route('update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- タイトル入力フィールド --}}
        <div class="form-group mb-3">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" 
                   value="{{ old('title', $blog->title) }}">
        </div>

        {{-- 内容入力フィールド --}}
        <div class="form-group mb-3">
            <label for="content">内容</label>
            <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $blog->content) }}</textarea>
        </div>

        {{-- 現在の画像の表示セクション --}}
        @if($blog->image)
            <div class="form-group mb-3">
                <label>現在の画像</label>
                <div>
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" style="max-width: 200px; height: auto;">
                </div>
            </div>
        @endif

        {{-- 新しい画像のアップロードセクション --}}
        <div class="form-group mb-3">
            <label for="image">画像をアップロード</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        {{-- アクションボタン --}}
        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('detail', $blog->id) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
