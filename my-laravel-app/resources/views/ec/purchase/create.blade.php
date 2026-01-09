@extends('layouts.app')

@section('title', '商品購入')

@section('content')
<div class="products-container">
  <div class="page_head">
    <h1 class="page_title">商品購入</h1>
    <a href="{{ route('ec.products.show', $product) }}" class="search-btn">商品詳細へ戻る</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="table-wrap" style="padding:16px;">
    <table class="products-table">
      <tbody>
        <tr>
          <th style="width:160px;">商品名</th>
          <td>{{ $product->name }}</td>
        </tr>
        <tr>
          <th>価格</th>
          <td>¥{{ number_format($product->price) }}</td>
        </tr>
        <tr>
          <th>在庫</th>
          <td>{{ $product->stock }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <form method="POST" action="{{ route('ec.purchase.store', $product) }}" class="product-form">
    @csrf

    <div class="form-row">
      <label>購入個数</label>
      <input
        type="number"
        name="quantity"
        value="{{ old('quantity', 1) }}"
        min="1"
        max="{{ $product->stock }}"
        {{ $product->stock <= 0 ? 'disabled' : '' }}
      >
      @if($product->stock <= 0)
        <div style="margin-top:6px;color:#c00;">在庫切れのため購入できません</div>
      @endif
    </div>

    <but
