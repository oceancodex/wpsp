<?php

namespace WPSP\App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
		//
//		View::addNamespace('errors', resource_path('views/errors'));
		$this->loadViewsFrom(resource_path('views/errors'), 'errors');
	}

}