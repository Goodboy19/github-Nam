<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/google',function (){
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/google/callback',function (){
    return '<h1>Google callback </h1>';
});

Route::get('auth/facebook',function (){
    return Socialite::driver('github')->redirect();
})->name('auth.facebook');

Route::get('/auth/facebook/callback',function (){
    $user = Socialite::driver('google')->user();
    dd($user);
});

Route::get('auth/github',function (){
    $user = Socialite::driver('github')->redirect();
})->name('auth.github');
