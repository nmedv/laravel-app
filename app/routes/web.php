<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DbController;

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
	[DbController::class, 'getDbPage']
)->name('db');

Route::get('/db/clear/{table}',
	[DbController::class, 'removeData']
)->name('db.clear');

Route::post('/db/add-entry/',
	[DbController::class, 'addEntry']
)->name('db.addEntry');

Route::get('/db/get',
	[DbController::class, 'getData']
)->name('db.getData');

Route::post('/db/delete-entry',
	[DbController::class, 'deleteEntry']
)->name('db.deleteEntry');

Route::get('/login', function () {
	return view('login');
})->name('login');