<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthGitHubController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
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




Route::delete('/logout', [AuthController::class, "logout"])->name("logout")->middleware('auth');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getUser', UserController::class)->name('get.user');
});

Route::middleware(['guest'])->group(function () {
    Route::post("/sign-up-mail", [AuthController::class, "signUp"])->name("signuup");
    Route::post("/login", [AuthController::class, "login"])->name("login");
    Route::post("/send-pass", [AuthController::class, "sendPass"])->name("send.pass");
    Route::post("/reset-password", [AuthController::class, "resetPass"])->name("reset.pass");
});


Route::get("/category-show", [CategoryController::class, 'show'])->name('category.show');
Route::get("/brand-show", [BrandController::class, 'show'])->name('brand.show');
Route::get("/products-all", [ProductController::class, 'showAll'])->name('products.all');


Route::group(
    ['middleware' => 'web'],
    function () {
        Route::get('/auth/github/redirect', [AuthGitHubController::class, 'redirect'])
            ->name('github.redirect');
        Route::get('/auth/github/callback', [AuthGitHubController::class, 'callback'])->name('github.callback');
    }
);

Route::get('/qwer')->name('password.reset');
