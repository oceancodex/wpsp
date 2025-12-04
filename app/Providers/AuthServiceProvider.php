<?php

namespace WPSP\App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use WPSP\App\Models\UsersModel;
use WPSP\App\Policies\UsersPolicy;

class AuthServiceProvider extends ServiceProvider {

	/**
	 * The policy mappings for the application.
	 */
	protected $policies = [
//		UsersModel::class => UsersPolicy::class
	];

	/**
	 * Register services.
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot() {
//		$this->registerPolicies();
	}

}
