<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/logout', function () {
	Auth::logout();
	return redirect('/');
});

Route::any('/{wildcard?}', function () {
	if(Auth::check()) return view('home');
	else return view('welcome');
})->where('wildcard', '.*');
