@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="mypage-container">

  <h1 class="page_title">マイページ</h1>

  {{-- 上部：アカウント情報 --}}
  <section class="mypage-card">
    <div class="mypage-card__head">

      {{-- Breezeを使っているならこれでOK --}}
     <a class="btn btn-primary" href="{{ route('profile.edit') }}">アカウント編集</a>
    </div>

    <div class="mypage-grid">
      <div>
        <div class="kv"><span class="kv__label">ユーザ名：</span>{{ $user->name }}</div>
        <div class="kv"><span class="kv__label">Eメール：</span>{{ $user->email }}</div>
    </div>

    <div>
        <div class="kv"><span class="kv__label">名前:</span>{{ $user->name_kanji }}</div>
        <div class="kv"><span class="kv__label">カナ:</span>{{ $user->email }}</div>
      </div>
  </section>

  {{-- 中部：出品商品（商品番号昇順） --}}
  <section class="mypage-card">
    <div class="mypage-card__head">
      <h2 class="mypage-subtitle"><出品商品></h2>
      <a class="btn btn-primary" href="{{
