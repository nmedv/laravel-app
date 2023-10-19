<?php

namespace App\Extensions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Auth\User;

class FormUserProvider implements UserProvider
{
	private $model;

	public function __construct(User $userModel)
	{
		$this->model = $userModel;
	}

	public function retrieveById($identifier) {}
	public function retrieveByToken($identifier, $token) {}
	public function updateRememberToken(Authenticatable $user, $token) {}

	public function retrieveByCredentials(array $credentials)
	{
		if (empty($credentials))
			return;

		$user = $this->model->fetchUserByCredentials($credentials);
		return $user;
	}

	public function validateCredentials(Authenticatable $user, array $credentials)
	{
		return (
			$credentials['username'] == $user->getAuthIdentifier() &&
			Hash::check($credentials['password'], $user->getAuthPassword())
		);
	}
}