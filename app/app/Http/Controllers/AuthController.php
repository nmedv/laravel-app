<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use Illuminate\Contracts\Auth\Guard;

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
		return redirect(route("index"));
	}


	public function register_process(Request $request)
	{
		$data = $request->validate([
			"username" => ["required", "string"],
			"email"    => ["required", "email", "string", "unique:users,email"],
			"password" => ["required", "confirmed"]
		]);

		$user = User::create([
			"username" => $data["username"],
			"email"    => $data["email"],
			"password" => Hash::make($data["password"])
		]);

		if ($user) {
			Auth::login($user);
		}

		return redirect(route("index"));
	}


	public function login_process(Request $request)
	{
		$data = $request->validate([
			"username" => ["required", "string"],
			"password" => ["required"]
		]);

		if (Auth::validate($data)) {
			return redirect(route("index"));
		}

		return redirect(route("login"))->withErrors(["login" => "Неправильное имя пользователя или пароль"]);
	}
}