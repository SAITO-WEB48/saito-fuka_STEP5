@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')
<div style="max-width:600px; margin:40px auto;">
    <h1 class="contact-title">お問い合わせフォーム</h1>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <p style="color:green;">
            {{ session('success') }}
        </p>
    @endif

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url()->current() }}">
        @csrf

        <div class="form-group">
            <label>名前</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-input">
        </div>

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-input">
        </div>

        <div class="form-group">
            <label>お問い合わせ内容</label>
            <textarea name="message" class="form-textarea">{{ old('message') }}</textarea>
        </div>

    <div class="btn-group">
        <button type="submit" class="btn btn-primary">
            送信
        </button>
          
        <button type="button"
                class="btn btn-secondary"
                 onclick="history.back()">
            戻る
        </button>
    </div>
@endsection
