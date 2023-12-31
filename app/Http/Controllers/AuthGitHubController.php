<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthGitHubController extends Controller
{
    public function redirect()
    {
        return  Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser =  Socialite::driver('github')->user();
        $user = User::updateOrCreate(
            ['github_id' => $githubUser->id],
            [
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'password' => Hash::make(str()->random(20)),
            ]
        );

        Auth::login($user);
        return redirect('/');
    }
}
