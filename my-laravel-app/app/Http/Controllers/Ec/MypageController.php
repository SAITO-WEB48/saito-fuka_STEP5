<?php

namespace App\Http\Controllers\Ec;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class MypageController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $listedProducts = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        $orders = Order::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('mypage.index', compact('user', 'listedProducts', 'orders'));
    }
}
