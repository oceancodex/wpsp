<?php

namespace WPSP\App\Providers;

use Illuminate\Support\ServiceProvider;
use WPSP\App\Models\UsersModel;
use WPSP\App\Observers\UsersObserver;

class EventServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 */
	public function register(): void {
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
		UsersModel::observe(UsersObserver::class);
	}

}