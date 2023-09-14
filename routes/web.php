<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('index');

Route::get('/db',
	'App\Http\Controllers\DbController@getData'
)->name('db');

Route::post('/db/post',
	'App\Http\Controllers\DbController@setData'
)->name('dbpost');

Route::get('/login', function () {
    return view('login');
})->name('login');