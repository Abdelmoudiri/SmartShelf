<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'in:admin,custumor',
        ]);

        // $userData = array_merge($validatedData, ['role' => $validatedData['role'] ?? 'custumor']);

        $user = User::create($validatedData);

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'user' => $user
        ]);
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        if($user->status == 'Suspended'){
            return response([
                'message' => 'Vous êtes Suspendu pour le Moment !'
            ]);
        }

        $token = $user->createToken('gen-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $user->role 
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie.'
        ], 200);
    }
}
