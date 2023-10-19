<?php

namespace App\Providers;

use App\Models\Auth\User;
use App\Extensions\FormUserProvider;
use App\Services\Auth\FormUserGuard;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
		$this->registerPolicies();

		$this->app->bind('App\Models\Auth\User', function ($app) {
			return new User();
		});

		Auth::provider('form-users', function ($app, array $config) {
			return new FormUserProvider($app->make('App\Models\Auth\User'));
		});

		Auth::extend('form-auth', function ($app, $name, array $config) {
			return new FormUserGuard(
				Auth::createUserProvider($config['provider']), $app->make('request'));
		});

		Gate::define("view-tables", function (?User $user) {
			if ($user) {
				return true;
			}
			
			return false;
		});
    }
}
