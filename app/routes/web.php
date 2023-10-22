<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TablesController;
use App\Http\Controllers\AuthController;


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

Route::get('/test', function () {
	return view('test');
})->name('test');


/* Tables */

Route::get('/tables',
	[TablesController::class, 'tables']
)->middleware(['auth', 'verified'])->name('tables');

Route::name('tables.')->group(function () {
	Route::post('/tables/add',
		[TablesController::class, 'add']
	)->name('add');

	Route::post('/tables/delete',
		[TablesController::class, 'delete']
	)->name('deletе');

	Route::get('/tables/clear',
		[TablesController::class, 'clear']
	)->name('clear');
});


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


/* Email */

Route::get('/email/verify', function () {
	return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return view('verify-email-success');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/* Cabinet */

Route::get('/cabinet', function () {
	return view('cabinet');
})->middleware(['auth', 'verified'])->name('cabinet');