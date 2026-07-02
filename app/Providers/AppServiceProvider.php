<?php

namespace WPSP\App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use WPSP\App\Widen\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider {

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
		RateLimiter::for('3rpm', function (\Illuminate\Http\Request $request) {
			return Limit::perMinute(3);
		});

		//
//		View::addNamespace('errors', resource_path('views/errors'));
		$this->loadViewsFrom(resource_path('views/errors'), 'errors');
	}

}