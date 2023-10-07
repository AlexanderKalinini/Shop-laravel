<?php

use App\Http\Controllers\AuthController;
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


Route::post("/sign-up-mail", [AuthController::class, "signUp"])->name("signUp");
Route::post("/login", [AuthController::class, "login"])->name("login");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");





Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get(
        '/getUser',
        GetController::class
    );
});
