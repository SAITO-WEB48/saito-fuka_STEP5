<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // メール & パスワードでログイン試行
        if (! Auth::attempt($request->only('email', 'password'))) {
            //失敗したら401を返す
            return response()->json([
                'message' => 'ログインに失敗しました',
            ], 401);
        }

        // ログイン中ユーザーを取得
        $user = Auth::user();

        // アクセストークンを発行（Sanctum）
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }
}
