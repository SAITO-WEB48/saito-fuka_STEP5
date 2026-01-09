<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Databese\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    //保存を許可するカラム
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    //ユーザーとの関係
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // 商品との関係
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
