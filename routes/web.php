<?php

use Illuminate\Support\Facades\Route;

Route::get('/web/login', function() {})->name('login');
Route::post('/web/logout', function() {
	\Illuminate\Support\Facades\Auth::logout();
})->name('logout');

Route::get('/web/abc', function() {
//	\Illuminate\Support\Facades\Auth::logout();
//	\Illuminate\Support\Facades\Auth::attempt(['name' => 'admin', 'password' => '123@123##'], true);
//	dump(session()->all());
//	echo '<pre style="background:white;z-index:9999;position:relative">'; print_r(\Illuminate\Support\Facades\Auth::user()); echo '</pre>';
//	return view('modules.admin-pages.wpsp.navigation');
});