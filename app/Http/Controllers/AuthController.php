<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $validator = Validator::make(Request::all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:30'],
        ], [
            'password.required' => 'لطفا رمزعبور را وارد کنید',
            'password.min' => 'رمز عبور باید حداقل 6 کاراکتر باشد',
            'password.max' => 'رمز عبور باید حداکثر 30 کاراکتر باشد',
            'email.required' => 'لطفا ایمیل را وارد کنید',
            'email.email' => 'ایمیل نامعتبر است',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }
        $user = User::where('email', Request::input('email'))->first();
        if (!empty($user)) {
            if (Hash::check(Request::input('password'), $user->password)) {
                return response()->json(['message' => 'Login succeeded'])->withCookie(cookie('token', JWT::encode($user, env('JWT_SECRET')), 3600, null, null, null, true));
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function user(\Illuminate\Http\Request $request)
    {
        return response()->json($request->user);
    }

    public function logout()
    {
        return response()->json(['message' => 'Log out succeeded'])->withCookie(Cookie::forget('token'));
    }
}
