@extends('layouts.app')

@section('title', 'アカウント編集')

@section('content')
<div class="products-container">
  <h1 class="page_title">アカウント編集</h1>

  @if (session('status') === 'profile-updated')
    <div style="margin:12px 0; padding:10px 12px; background:#e8fff7; border:1px solid #b7f5dd; border-radius:8px;">
      更新しました
    </div>
  @endif

  <form method="post" action="{{ route('profile.update') }}" class="product-form">
    @csrf
    @method('patch')

    <div class="form-group">
      <label class="form-label" for="name">ユーザー名</label>
      <input class="form-input" id="name" name="name" type="text"
             value="{{ old('name', $user->name) }}" required>
      @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="email">Eメール</label>
      <input class="form-input" id="email" name="email" type="email"
             value="{{ old('email', $user->email) }}" required>
      @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="name_kanji">名前</label>
      <input class="form-input" id="name_kanji" name="name_kanji" type="text"
             value="{{ old('name_kanji', $user->name_kanji) }}">
      @error('name_kanji') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="name_kana">カナ</label>
      <input class="form-input" id="name_kana" name="name_kana" type="text"
             value="{{ old('name_kana', $user->name_kana) }}">
      @error('name_kana') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-actions">
      <a href="{{ route('ec.mypage.index') }}" class="btn btn-secondary">戻る</a>
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </form>
</div>
@endsection
