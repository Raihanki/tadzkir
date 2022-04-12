<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __invoke(Request $request) :  JsonResponse
    {
        $data = $request->validate([
            "name" => "required|string|max:30|min:3",
            "email" => "required|email|unique:users",
            "password" => ['required', 'confirmed', Password::min(8)],
        ]);
        try {
            User::create($data);
            return response()->json([
                'message' => 'User created successfully',
                'data' => $data
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'User creation failed',
            ], 500);
        }
    }
}
