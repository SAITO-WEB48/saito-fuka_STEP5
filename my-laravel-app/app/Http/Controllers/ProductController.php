<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     //  商品新規登録画面
    public function create()
    {
        return view('ec.products.create');
    }

    //  商品登録（DB保存）
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::create($validated);

        return redirect()
            ->route('ec.products.show', $product)
            ->with('success', '商品を登録しました');
    }

      //  購入処理
    public function purchase(Request $request)
    {
    try {
        // バリデーション
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'message' => '商品が存在しません'
            ], 404);
        }

        if ($product->stock < $request->quantity) {
            return response()->json([
                'message' => '在庫が不足しています'
            ], 400);
        }

        DB::beginTransaction();

        $product->stock -= $request->quantity;
        $product->save();

        $order = Order::create([
            'user_id'    => $request->user()->id,
            'product_id' => $product->id,
            'quantity'   => $request->quantity
        ]);

        DB::commit();

        return response()->json([
            'message' => '購入が完了しました',
            'order' => $order
        ], 201);

    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json([
            'message' => 'エラー',
            'error' => $e->getMessage(),  // ← これが重要
        ], 500);
    }
  }
}
