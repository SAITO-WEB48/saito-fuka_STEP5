<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    // フォーム表示（EC・ブログ共通）
    public function showForm()
    {
        return view('contact.form');
    }

    // 送信処理（EC・ブログ共通）
    public function submitForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // 今は保存しない（練習用）
        return back()->with('success', 'お問い合わせを送信しました');
    }
}
