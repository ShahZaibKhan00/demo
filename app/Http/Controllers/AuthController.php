<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function register(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);
        $data = $request->all();
        $user = User::create($data);
        return response()->json([
            'data'          => $user
        ], 200);
    }

    function login(Request $request) {
        $request->validate([
            'email' => ['required','string', 'email'],
            'password' => ['required'],
        ]);
        $userMail = User::where('email', $request->email)->first();
        if (!empty($userMail)) {
            if (password_verify($request->password, $userMail->password)) {
                $token = $userMail->createToken('mytoken')->plainTextToken;
                return response()->json([
                    'data'          => $userMail, 'access_token'  => $token,
                    'token_type'    => 'Bearer',
                    'message' => "User has been Logged successfully"
                ], 200);
            }
            else {
                return response()->json([
                    'data'          => $userMail,
                    'message' => "Password does not Match"
                ], 404);
            }
        }
        else {
            return response()->json([
                'data'          => $userMail,
                'message' => "User not found"
            ], 404);
        }
    }

    function profile() {
        $user = Auth::user();
        return response()->json([
            'data'          => $user,
            'message' => "User Info Fetched",
            'id' => Auth::user()->password
        ], 200);
    }

    function logout() {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'data'          => $user,
            'message' => "User has been Logged out successfully"
        ], 200);
    }
}
