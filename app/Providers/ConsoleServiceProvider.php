<?php

namespace WPSP\App\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register(): void {
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void {
		$this->app->extend('command.db.wipe', function ($command, $app) {
			return new \WPSP\App\Console\Commands\Database\WipeCommand();
		});
		$this->app->extend('command.db.seed', function ($old, $app) {
			return new \WPSP\App\Console\Commands\Database\Seeds\SeedCommand($app['db.seeder']);
		});
	}

}
