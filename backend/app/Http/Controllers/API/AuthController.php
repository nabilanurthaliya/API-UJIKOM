<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return response()->json([
            'message' => 'Register berhasil'
        ]);
    }

    public function login(Request $request)
    {
        return response()->json([
            'message' => 'Login berhasil'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}