<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;



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

    public function sendPass(Request $request)
    {

        $request->validate([
            'email' => ['email', 'required',],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? ['status' => __($status)]
            : ['email' => __($status)];
    }

    public function resetPass(Request $request)
    {

        $res = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);



        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? ['status' => __($status)]
            : ['status' => __($status)];
    }
}
