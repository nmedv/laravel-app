<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
	public function request(Request $request)
	{
		return view('forgot-password');
	}

	public function reset(string $token)
	{
		return view('reset-password', ['token' => $token]);
	}

	public function sendEmail(Request $request)
	{
		$request->validate(['email' => 'required|email']);
		$status = Password::sendResetLink($request->only('email'));
		
		if ($status == Password::RESET_LINK_SENT) {
			return back()->with(['status' => __($status)]);
		} else {
			return back()->withErrors(['email' => __($status)]);
		}
	}

	public function update(Request $request)
	{
		$request->validate([
			'token'    => ['required'],
			'email'    => ['required', 'email'],
			'password' => ['required', 'min:8', 'confirmed'],
		]);
	 
		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(60));
	 
				$user->save();
	 
				event(new PasswordReset($user));
			}
		);
	
		if ($status == Password::PASSWORD_RESET) {
			return redirect()->route('login')->with('status', __($status));
		} else {
			return back()->withErrors(['email' => [__($status)]]);
		}
	}
}
