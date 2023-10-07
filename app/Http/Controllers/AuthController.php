<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;



class AuthController extends Authenticate
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function signUp(SignUpRequest $request)
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

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();


        if (auth()->attempt($credentials)) {

            return response($credentials);
        }

        throw new \Exception("Такой пользователь не зарегистрирован");
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return 'redirect;';
    }
}