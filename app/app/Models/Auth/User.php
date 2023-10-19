<?php

namespace App\Models\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User implements AuthenticatableContract
{
	private string $username = "";
	private string $password = "";
	protected string $rememberTokenName = "remember_token";

	public function __construct()
	{
		
	}

	public function fetchUserByCredentials(array $credentials)
	{
		$username = $credentials["username"];
		$query = DB::select("SELECT * FROM form_users WHERE username = ?", [$username]);

		if ($query) {
			$data = $query[0];
			$this->username = $data->username;
			$this->password = $data->password;
		}

		return $this;
	}

	public static function create(array $data)
	{
		return DB::insert(
			"INSERT INTO form_users (username, email, password) VALUES (?, ?, ?)",
			[$data["username"], $data["email"], $data["password"]]
		);
	}

	public function getAuthIdentifierName()
	{
		return "username";
	}

	public function getAuthIdentifier()
	{
		return $this->{$this->getAuthIdentifierName()};
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getRememberToken()
	{
		if (!empty($this->getRememberTokenName())) {
			return $this->{$this->getRememberTokenName()};
		}
	}

	public function setRememberToken($value)
	{
		if (!empty($this->getRememberTokenName())) {
			$this->{$this->getRememberTokenName()} = $value;
		}
	}

	public function getRememberTokenName()
	{
		return $this->rememberTokenName;
	}
}