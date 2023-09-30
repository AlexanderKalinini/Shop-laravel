<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;


use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;


class AuthController extends Authenticate
{
    use AuthorizesRequests, ValidatesRequests;

    public function showLogin()
    {
        return inertia("LoginPage");
    }

    public function showLoginOnMail()
    {
        return inertia("LoginOnMail");
    }

    public function loginProcess(LoginRequest $request)
    {
    }

    public function showReg()
    {
        return inertia("RegPage");
    }
    public function showRegOnMail()
    {
        return inertia("RegistrationMailPage");
    }

    public function signUpProcess(SignUpRequest $request)
    {
        $credentials = $request->validated();
        dd($credentials);
        return to_route("home");
    }

    public function showLostPassword()
    {
        return inertia("LostPassword");
    }
}
