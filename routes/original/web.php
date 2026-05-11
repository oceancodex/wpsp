<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use WPSP\App\Http\Controllers\ApisController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('login', function() { return view('auth.login-original'); })->name('login');
Route::post('login', [ApisController::class, 'loginOriginal'])->middleware(VerifyCsrfToken::class);
Route::get('logout', function() { Auth::logout(); return redirect()->route('welcome'); });