<?php

namespace App\Http\Controllers;

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


	public function logout()
	{
		Auth::logout();
		return redirect("/");
	}


	public function register_process(Request $request)
	{
		$data = $request->validate([
			"name"    => ["required", "string"],
			"email"    => ["required", "email", "string", "unique:users,email"],
			"password" => ["required", "confirmed"]
		]);

		$user = User::create([
			"name"     => $data["name"],
			"email"    => $data["email"],
			"password" => Hash::make($data["password"])
		]);

		if ($user) {
			Auth::login($user, $request->has("remember"));
		}

		return redirect(route("index"));
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