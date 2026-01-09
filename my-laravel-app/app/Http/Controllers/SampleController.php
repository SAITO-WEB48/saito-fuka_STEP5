<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sample;

class SampleController extends Controller
{
    // 以前の「はじめてのView」
    public function showSample()
    {
        return view('sample'); // resources/views/sample.blade.php
    }

    // DBの一覧表示
    public function index()
    {
        $samples = Sample::all();
        return view('samples.index', ['samples' => $samples]);
    }
}
