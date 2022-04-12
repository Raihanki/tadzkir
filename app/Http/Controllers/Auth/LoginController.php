<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request) : JsonResponse
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || Hash::check($data['password'], $user['password'])) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        $token = $user->createToken($request->header('User-Agent'))->plainTextToken;
        return response()->json([
            'token' => $token,
        ], 200);
    }
}
