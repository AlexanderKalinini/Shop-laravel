<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthGitHubController;
use App\Http\Controllers\GetController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get(
        '/getUser',
        GetController::class
    );
});

Route::post("/sign-up-mail", [AuthController::class, "signUp"])->name("signUp");
Route::post("/login", [AuthController::class, "login"])->name("login");
Route::post("/send-pass", [AuthController::class, "sendPass"])->name("send.pass");
Route::post("/reset-password", [AuthController::class, "resetPass"])->name("reset.pass");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");


Route::group(
    ['middleware' => 'web'],
    function () {
        Route::get('/auth/github/redirect', [AuthGitHubController::class, 'redirect'])
            ->name('github.redirect');
        Route::get('/auth/github/callback', [AuthGitHubController::class, 'callback'])->name('github.callback');
    }
);
Route::get('/qwer', function (string $token) {
})->name('password.reset');
