<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'TNGブログ')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-primary-subtle py-3 mb-4 border-bottom text-center">
  <div class="container">
    <h3 class="mb-3">TNGブログ</h3>

    @auth
      <div>ログインユーザー: {{ auth()->user()->name }}</div>

      <div class="mt-2">
        <!-- ← ) を追加 -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

        <a class="btn btn-outline-danger"
           href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          ログアウト
        </a>
      </div>
    @endauth
  </div>
</header>

{{-- エラーメッセージ（メール送信失敗など） --}}
@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif


<div class="container">
  <!-- フラッシュメッセージ -->
  <div class="row justify-content-center">
  </div>

  <!-- 各画面の中身 -->
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      @yield('content')
    </div>
  </div>
</div>

<footer class="bg-primary-subtle mt-5">
  <div class="container-fluid d-flex justify-content-center py-3">
    <p class="mb-0">&copy; 2025 All Rights Reserved.</p>
  </div> <!-- ← footer内のdivを閉じる -->
</footer>

</body>
</html>
