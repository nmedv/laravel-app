<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;


class FormUserGuard implements Guard
{
	private Dispatcher $events;
	protected $request;
	protected $provider;
	protected $user;

	public function __construct(UserProvider $provider, Request $request)
	{
		$this->request = $request;
		$this->provider = $provider;
		$this->user = NULL;
	}

	public function check()
	{
		return ! is_null($this->user());
	}

	public function guest()
	{
		return ! $this->check();
	}

	public function user()
	{
		if (! is_null($this->user)) {
			return $this->user;
		}
	}

	public function id()
	{
		if ($user = $this->user()) {
			return $this->user()->getAuthIdentifier();
		}
	}

	public function validate(Array $credentials = [])
	{
		if (empty($credentials['username']) || empty($credentials['password'])) {
			if (!$credentials = $this->request->all()) {
				return false;
			}
		}

		$user = $this->provider->retrieveByCredentials($credentials);
		
		if (!is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
			$this->user = $user;
			return true;
		}
		
		return false;
	}

	public function login(Authenticatable $user, $remember = false)
	{
		$this->events?->dispatch(new Login("form", $user, $remember));

		$this->setUser($user);
	}

	public function logout()
	{
		$user = $this->user();
		
	}

	public function hasUser()
	{
		return ! is_null($this->user);
	}

	public function setUser(Authenticatable $user)
	{
		$this->user = $user;
		return $this;
	}
}