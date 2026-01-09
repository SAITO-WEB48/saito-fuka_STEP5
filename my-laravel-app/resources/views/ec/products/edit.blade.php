@extends('layouts.app')

@section('title', '商品編集')

@section('content')
<div class="products-container">

  <div class="page_head">
    <h1 class="page_title">商品編集</h1>
    <a href="{{ route('ec.products.show', $product) }}" class="search-btn">
      商品詳細へ戻る
    </a>
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
    <form method="POST"
          action="{{ route('ec.products.update', $product) }}"
          enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <table class="products-table">
        <tbody>
          <tr>
            <th style="width:160px;">商品番号</th>
            <td>{{ $product->id }}</td>
          </tr>

          <tr>
            <th>商品名</th>
            <td>
              <input type="text" name="name" class="form-control"
                     value="{{ old('name', $product->name) }}" required>
            </td>
          </tr>

          <tr>
            <th>商品説明</th>
            <td>
              <textarea name="description" class="form-control" rows="6">
{{ old('description', $product->description) }}</textarea>
            </td>
          </tr>

          <tr>
            <th>料金</th>
            <td>
              <input type="number" name="price" class="form-control"
                     value="{{ old('price', $product->price) }}"
                     min="0" required>
            </td>
          </tr>

          <tr>
            <th>在庫</th>
            <td>
              <input type="number" name="stock" class="form-control"
                     value="{{ old('stock', $product->stock) }}"
                     min="0" required>
            </td>
          </tr>

          <tr>
            <th>画像</th>
            <td>
              <div style="display:flex; gap:16px; align-items:center;">
                @if($product->image)
                  <img
                    src="{{ asset('storage/'.$product->image) }}"
                    style="width:160px; height:160px; object-fit:cover; border-radius:12px;">
                @else
                  <div style="width:160px; height:160px; background:#eee; border-radius:12px;"></div>
                @endif

                <div>
                  <input type="file"
                         name="image"
                         class="form-control"
                         accept="image/*">
                  <div style="font-size:12px; color:#666; margin-top:6px;">
                    新しい画像を選んだ場合のみ差し替え
                  </div>
                </div>
              </div>
            </td>
          </tr>

        </tbody>
      </table>

      <div class="product-actions" style="margin-top:16px;">
        <button type="submit" class="btn btn-primary">
          更新する
        </button>
        <a href="{{ route('ec.products.show', $product) }}" class="btn-back">
          戻る
        </a>
      </div>

    </form>
  </div>
</div>
@endsection
