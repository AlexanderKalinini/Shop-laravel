<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class AuthController extends Authenticate
{
    use AuthorizesRequests, ValidatesRequests;

    public function signUpProcess(SignUpRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create([
            'name' => $credentials["name"],
            'email' => $credentials["email"],
            'password' => Hash::make($credentials["password"]),
        ]);

        if ($user) {
            auth()->login($user);
        }

        return $user;
    }

    public function loginProcess(LoginRequest $request)
    {
    }
}
