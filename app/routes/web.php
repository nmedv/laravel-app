<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TablesController;

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


/* Index */

Route::get('/', function () {
	return view('index');
})->name('index');


/* Tables */

Route::get('/tables',
	[TablesController::class, 'tables']
)->name('tables');

Route::post('/tables/add',
	[TablesController::class, 'add']
)->name('tables.add');

Route::post('/tables/delete',
	[TablesController::class, 'delete']
)->name('tables.deletе');

Route::get('/tables/clear',
	[TablesController::class, 'clear']
)->name('tables.clear');


/* Login */

Route::get('/login', function () {
	return view('login');
})->name('login');