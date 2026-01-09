@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="products-container">

  <div class="page_head">
    <h1 class="page_title">商品一覧</h1>
    <a href="{{ route('ec.products.create') }}" class="search-btn">
      商品を追加
    </a>
  </div>

  <form action="{{ route('ec.products.index') }}" method="GET" class="search-form" style="margin-bottom:16px;">
  <input
    type="text"
    name="keyword"
    placeholder="商品名を入力"
    value="{{ request('keyword') }}"
  >

  <input
    type="number"
    name="min_price"
    placeholder="最低価格"
    value="{{ request('min_price') }}"
  >

  <span>〜</span>

  <input
    type="number"
    name="max_price"
    placeholder="最高価格"
    value="{{ request('max_price') }}"
  >

  <button type="submit" class="search-btn">検索</button>
</form>


  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if($products->isEmpty())
    <div class="empty">
      <p class="empty_text">商品がまだありません</p>
    </div>
  @else
    <div class="table-wrap">
      <table class="products-table">
        <thead>
          <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>画像</th>
            <th>料金</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->description }}</td>
             
              {{-- 画像 --}}
              <td>
               @if($product->image)
               <img
                src="{{ asset('storage/'.$product->image) }}"
                style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
         @else
            <div style="width:40px;height:40px;background:#eee;border-radius:6px;"></div>
         @endif
             </td>

              <td>¥{{ number_format($product->price) }}</td>


            {{-- 詳細ボタン --}}
              <td>
            <a href="{{ route('ec.products.show', $product) }}" class="detail-btn">
              詳細
            </a>
            </td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  @endif

</div>
@endsection
