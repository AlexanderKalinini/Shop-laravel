<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{page}', Controller::class)->where('page', '.*');

// Route::middleware('guest')->group(function () {
//
//     Route::get('login', [AuthController::class, 'showLogin'])->name('showLogin');
//     Route::get('login-mail', [AuthController::class, 'showLoginOnMail'])->name('loginOnMail');
//     Route::post('login-process', [AuthController::class, 'loginProcess'])->name('loginProcess');
//     Route::get('lost-password', [AuthController::class, 'showLostPassword'])->name('formLostPassword');
//
//     Route::get('sign-up', [AuthController::class, 'showReg'])->name('showSignUp');
//     Route::get('sign-up-mail', [AuthController::class, 'showRegOnMail'])->name('signUpOnMail');
//     Route::post('sign-up-process', [AuthController::class, 'signUpProcess'])->name('signUpProcess');
// });
//
// Route::middleware('auth')->group(function () {
// });