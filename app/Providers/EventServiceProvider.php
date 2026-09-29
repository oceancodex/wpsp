<?php

namespace WPSP\App\Providers;

use Illuminate\Support\ServiceProvider;
use WPSP\App\Models\UsersModel;
use WPSP\App\Observers\UsersObserver;

class EventServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot() {
		UsersModel::observe(UsersObserver::class);
	}

}