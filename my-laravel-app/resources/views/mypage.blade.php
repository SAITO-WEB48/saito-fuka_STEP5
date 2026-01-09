{{-- 検索は /mypage にGETで --}}
<form action="{{ route('mypage') }}" method="GET" class="my-3">
  ...
</form>

<table class="table table-bordered align-middle"> {{-- border属性は不要 --}}
  <thead>
    <tr>
      <th>投稿者</th> 
      <th>タイトル</th>
      <th>内容</th>
      <th>画像</th>
      <th>投稿日</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($blogs as $blog)
    <tr>
      <td>{{ $blog->user?->name ??'不明'  }}</td>

      <td>{{ $blog->title }}</td>
      <td>{{ $blog->content }}</td>
      <td style="width:160px">
        @if ($blog->image)
          <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
        @else
          ー
        @endif
      </td>
      <td>{{ $blog->created_at->format('Y-m-d') }}</td>
      <td>
        <a href="{{ route('detail', $blog->id) }}" class="btn btn-primary btn-sm">詳細</a>
      </td>
    </tr>
  @empty
    <tr><td colspan="5" class="text-center">該当する記事はありません。</td></tr>
  @endforelse
  </tbody>
</table>

