<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;

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
)->middleware(['auth'])->name('tables');

Route::post('/tables/add',
	[TablesController::class, 'add']
)->name('tables.add');

Route::post('/tables/delete',
	[TablesController::class, 'delete']
)->name('tables.deletе');

Route::get('/tables/clear',
	[TablesController::class, 'clear']
)->name('tables.clear');


/* Registration & Login */

Route::get('/register',
	[AuthController::class, 'register']
)->name('register');

Route::get('/login',
	[AuthController::class, 'login']
)->name('login');

Route::post('/register/process',
	[AuthController::class, 'register_process']
)->name('register.process');

Route::post('/login/process',
	[AuthController::class, 'login_process']
)->name('login.process');

Route::get('/logout',
	[AuthController::class, 'logout']
)->name('logout');