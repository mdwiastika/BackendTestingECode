<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken($request->email);
                return ResponseJsonTemplate::responseJson(202, 'success', 'Berhasil Login!', ['token' => $token->plainTextToken, $request->user()]);
            } else {
                return ResponseJsonTemplate::responseJson(403, 'error', 'Email & Password Salah', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(403, 'error', $th->getMessage(), null);
        }
    }
}
