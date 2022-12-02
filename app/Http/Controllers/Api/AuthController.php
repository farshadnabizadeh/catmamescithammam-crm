<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        // verify user + token
        if (!$token = auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                "status" => 0,
                "message" => "Invalid credentials"
            ]);
        }
        // send response
        return response()->json([
            "status" => 1,
            "message" => "Logged in successfully",
            "access_token" => $token
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            "status" => 1,
            "message" => "User logged out"
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }
}

