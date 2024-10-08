<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{

	public function register(Request $request)
	{
		return view("register");
	}


	public function login(Request $request)
	{
		return view("login");
	}


	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
    	$request->session()->regenerateToken();
		return redirect(route("index"));
	}


	public function register_process(Request $request)
	{
		$data = $request->validate([
			"name"     => ["required", "string"],
			"email"    => ["required", "email", "string", "unique:users,email"],
			"password" => ["required", "min:8", "confirmed"]
		]);

		$user = User::create([
			"name"     => $data["name"],
			"email"    => $data["email"],
			"password" => Hash::make($data["password"])
		]);

		if ($user) {
			event(new Registered($user));
			Auth::login($user, $request->has("remember"));
			return redirect(route("verification.notice"));
		}
		
		return back()->withErrors(["register" => "Не удалось создать аккаунт"]);
	}


	public function login_process(Request $request)
	{
		$data = $request->validate([
			"email"    => ["required", "email", "string"],
			"password" => ["required"]
		]);

		if (Auth::viaRemember()) {
			return redirect()->intended();
		}
		elseif (Auth::attempt($data, $request->has("remember"))) {
			$request->session()->regenerate();

			return redirect()->intended();
		}

		return back()->withErrors(["login" => "Неправильный адрес или пароль"]);
	}
}