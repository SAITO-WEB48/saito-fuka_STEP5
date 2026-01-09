@extends('app')

@section('title', 'ブログ詳細')

@section('content')
<!-- CSRFトークンをJavaScriptで使用するためのメタタグ　-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Font Awesomeの読み込み -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!-- 外部JavaScriptファイルの読み込み -->
 <script src="{{ asset('js/like.js') }}"></script>

<div class="container">
  <h1>ブログ詳細</h1>

  <h2>{{ $blog->title }}</h2>
  <p>投稿者: {{ $blog->user->name ??'不明' }}</p>
  <p class="mb-3">{{ $blog->content }}</p>

  @if($blog->image)
    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="max-width: 320px; height:auto;">
  @endif
    <p class="text-muted mt-2">{{ $blog->created_at->format('Y-m-d') }}</p>

    <!-- イイねボタン -->
    <div class="mb-3">
      <button id="like-btn" class="border-0 bg-transparent"
          data-blog-id="{{ $blog->id }}"
          @if(auth()->check() && $blog->likedBy(auth()->user()))
            style="color: red;"
        @endif
        >
        
          <i class="fas fa-heart"></i> <!-- Font Awesomeのハートアイコン -->
      </button>
      <span id="like-count">{{ $blog->likes()->count() }}</span>
    </div>

  <div class="mt-3 d-flex gap-2">
    <a href="{{ route('edit', $blog->id) }}" class="btn btn-primary">更新する</a>
    <a href="{{ route('index') }}" class="btn btn-secondary">一覧に戻る</a>
  </div>
</div>
@endsection
