<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5;

use Spatie\LaravelPackageTools\Package;
use WPSP\App\Widen\Commands\ActivityLog\V5\CleanActivitylogCommand;
use WPSP\Funcs;

class ActivitylogServiceProvider extends \Spatie\Activitylog\ActivitylogServiceProvider {

	public function configurePackage(Package $package): void {
		$package
			->name('laravel-activitylog')
			->hasConfigFile('activitylog-v5')
			->hasMigrations([
				'create_activity_log_table',
			])
			->hasCommand(CleanActivitylogCommand::class);
	}

	public function packageBooted(): void {
		if (Funcs::config('activitylog-v5.buffer.enabled', false)) {
			$this->registerActivityBufferFlushing();
		}
	}

}