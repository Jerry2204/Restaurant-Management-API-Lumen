<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return ApiResponse::error('Unauthorized', 401);
        }

        $user = auth()->user();
        $customClaims = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $token = JWTAuth::claims($customClaims)->fromUser($user);

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user(),
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ];

        return ApiResponse::success($data, 'Login successful!', 200);
    }

    public function me()
    {
        $user = auth()->user();

        return ApiResponse::success($user);
    }

    public function logout()
    {
        auth()->logout();

        return ApiResponse::success([], 'Logout successfully!');
    }

    public function refresh()
    {
        $user = auth()->user();
        $data = [
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'user' => $user,
            'expires_in' => auth()->factory()->getTTL() * 60 * 24,
        ];

        return ApiResponse::success($data, 'Token refreshed successfully!', 200);
    }
}
