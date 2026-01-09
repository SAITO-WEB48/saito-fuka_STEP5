<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

 // お気に入り（favorites）とのリレーション
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    // この商品を「このユーザー」がお気に入りしてるか？
    public function isFavoritedBy($user): bool
    {
        if (!$user) return false;

        return $this->favorites()
            ->where('user_id', $user->id)
            ->exists();
    }
}

