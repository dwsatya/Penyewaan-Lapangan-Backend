<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{
    // Register User
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    // Login User
    public function signin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $guard = 'user';

        // Check is admin
        $isAdmin = Admin::where('email', $request->email)->exists();
        if ($isAdmin) {
            $guard = 'admin';
        }

        try {
            // Check credentials
            if (!auth($guard)->attempt($credentials)) {
                return response()->json(['message' => 'Invalid email or password'], 401);
            }

            // Get user
            $user = auth($guard)->user();

            // Check role
            if (!in_array($user->role, ['user', 'admin'])) {
                return response()->json(['message' => 'Unauthorized role'], 403);
            }

            // Create payload
            $customClaims = [
                'id' => $user->id,
                'userName' => $user->userName,
                'email' => $user->email,
                'role' => $guard === 'user' ? 'user' : 'admin',
            ];

            // Create token
            $token = JWTAuth::claims($customClaims)->fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        return response()->json([
            'message' => 'Login successfully',
            'token' => $token,
            'role' => $guard === 'user' ? 'user' : 'admin',
        ], 200);
    }
}
