<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
		auth("web")->logout();
		return redirect(route("index"));
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
			"password" => bcrypt($data["password"])
		]);

		if ($user) {
			auth("web")->login($user);
		}

		return redirect(route("index"));
	}


	public function login_process(Request $request)
	{
		$data = $request->validate([
			"email"    => ["required", "email", "string"],
			"password" => ["required"]
		]);

		if (auth("web")->attempt($data)) {
			return redirect(route("index"));
		}

		return redirect(route("login"))->withErrors(["login" => "Неправильный адрес или пароль"]);
	}
}