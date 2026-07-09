<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use WPSP\App\Http\Controllers\ApisController;
use WPSP\App\Http\Middleware\PreventRequestForgery;
use WPSP\App\Http\Middleware\PreventRequestForgeryWithoutOrigin;

Route::get('/', function() { return view('welcome'); })->name('welcome');
Route::get('login', function() { return view('auth.login-original'); })->name('login');
Route::post('login', [ApisController::class, 'loginOriginal'])->middleware(PreventRequestForgeryWithoutOrigin::class);
Route::get('logout', function() { Auth::logout(); return redirect()->route('welcome'); });