<?php

namespace App\Http\Controllers\Ec;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // 購入画面表示
    public function create(Product $product)
    {
        return view('ec.purchase.create', compact('product'));
    }

    // 購入処理（POST）
    public function store(Request $request, Product $product)
    {
        // 在庫0は購入不可（画面から無理やりPOSTされても防ぐ）
        if ($product->stock <= 0) {
            return back()->withErrors(['quantity' => '在庫切れのため購入できません'])->withInput();
        }

        // 購入個数：1以上 & 在庫以下
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $product->stock],
        ]);

        try {
            DB::transaction(function () use ($product, $validated) {
                // 在庫の取り合い対策（同時購入でも安全に）
                $fresh = Product::lockForUpdate()->find($product->id);

                if ($fresh->stock < $validated['quantity']) {
                    throw new \RuntimeException('在庫が不足しています');
                }

                $fresh->stock -= $validated['quantity'];
                $fresh->save();

                Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $fresh->id,
                    'quantity' => $validated['quantity'],
                ]);
            });
        } catch (\Throwable $e) {
            return back()->withErrors(['quantity' => $e->getMessage()])->withInput();
        }

        return redirect()
            ->route('ec.products.show', $product)
            ->with('success', '購入しました');
    }
}
