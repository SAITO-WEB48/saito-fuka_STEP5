<?php

namespace App\Http\Controllers\Ec;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order; // 購入テーブルがordersの場合

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 出品商品：商品番号（id想定）昇順
        $listedProducts = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        // 購入商品：購入日(created_at)昇順
        $purchases = Order::with('product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mypage.index', compact('user', 'listedProducts', 'purchases'));
    }
}
