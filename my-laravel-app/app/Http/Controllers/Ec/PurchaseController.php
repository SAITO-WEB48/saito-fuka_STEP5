<?php

namespace App\Http\Controllers\Ec;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create(Product $product)
    {
        return view('ec.purchase.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        // まずは store() が呼べるか確認用
        return back()->with('success', 'store() が呼ばれました');
    }
}
