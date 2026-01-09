<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // コンストラクタ
    public function __construct(private Blog $blog = new Blog) {}

    // マイページ画面表示（ログインユーザーの投稿のみ）
    public function mypage()
    {
        $user_id = Auth::id();

        $blogs = Blog::where('user_id', $user_id)
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('mypage', compact('blogs'));
    }

    // 他人の投稿一覧画面表示
    public function index()
    {
        //ログインユーザーのIDを取得
        $user_id = Auth::id();

        //他人の投稿だけ取得
        $blogs = $this->blog->getOtherBlog($user_id);

        //ビューへ渡す
        return view('index', compact('blogs'));
    }

    // 詳細画面を表示
    public function show($id)
    {
        //$blog = Blog::findOrFail($id);

        //指定されたIDのブログ投稿と投稿者の情報を取得
        $blog = Blog::with('user')->findOrFail($id);
        return view('detail', compact('blog'));
    }

    // 新規投稿画面
    public function create()
    {
        return view('create');
    }

    // 新規投稿
     public function store(Request $request) 
    {
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        //  ログインユーザーのIDを保存
        $validated['user_id'] = auth()->id();

        Blog::create($validated);

        return redirect()->route('mypage')->with('success', 'ブログが投稿されました');
    }

    // 編集画面
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('edit', compact('blog'));
    }

    // 更新
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $blog->update($validated);

        return redirect()->route('detail', $blog->id)
                         ->with('success', 'ブログを更新しました');
    }

    // 検索
    public function search(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.$request->input('title').'%');
        }
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        $blogs = $query->orderBy('created_at', 'desc')->get();

        return view('index', compact('blogs'));
    }

    // 削除
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('index')->with('success', '記事が削除されました');
    }
}
