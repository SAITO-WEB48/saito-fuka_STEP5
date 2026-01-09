@extends('layouts.app')

@section('title', '商品新規登録')

@section('content')
<div class="products-container">

  <div class="page_head">
    <h1 class="page_title">商品新規登録</h1>
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

  <form method="POST" action="{{ route('ec.products.store') }}" class="product-form" enctype="multipart/form-data">
    @csrf

    <h2 class="form-title">商品登録</h2>

    <div class="form-group">
      <label class="form-label">商品名</label>
      <input class="form-input" type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">価格</label>
      <input class="form-input" type="number" name="price" value="{{ old('price') }}" min="0" required>
    </div>

    <div class="form-group">
      <label class="form-label">商品説明</label>
      <textarea class="form-textarea" name="description" rows="5">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
      <label class="form-label">在庫数</label>
      <input class="form-input" type="number" name="stock" value="{{ old('stock') }}" min="0" required>
    </div>

    <div class="form-group">
  <label class="form-label">商品画像</label>
  <input class="form-input" type="file" name="image" accept="image/*">
</div>


    <div class="form-actions">
  <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
  <button type="submit" class="btn btn-primary">登録</button>
</div>
  </form>
</div>
@endsection

