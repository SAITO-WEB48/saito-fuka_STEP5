<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;

class Blog extends Model
{
    use HasFactory;

    // 複数代入を許可するカラム
    protected $fillable = ['title', 'content', 'image', 'user_id'];

    // ログインユーザ以外のブログを取得
    public function getOtherBlog($user_id)
    {
        return $this->where('user_id', '!=', $user_id)
                    ->with('user')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    // 自分のブログを取得（マイページ /mypage 用）
    public function getOwnBlog($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->with('user')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    // 投稿者（usersテーブル）とのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // いいねとのリレーション（1つのブログに対して「いいね」は複数）
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // このブログを指定ユーザーがいいねしているか？
    public function likedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->likes()
                    ->where('user_id', $user->id)
                    ->exists();
    }
}
