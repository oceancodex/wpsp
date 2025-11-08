<?php

namespace WPSP\app\Providers;

use Illuminate\Support\ServiceProvider;
use WPSP\app\Console\Commands\DBWipeCommand;
use WPSP\app\Console\Commands\MigrateFreshCommand;

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
			return new DBWipeCommand();
		});
		$this->app->extend('command.migrate.fresh', function($oldCommand, $app) {
			return new MigrateFreshCommand();
		});
	}

}
