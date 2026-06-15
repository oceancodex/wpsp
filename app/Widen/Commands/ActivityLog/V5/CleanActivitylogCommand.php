<?php

namespace WPSP\App\Widen\Commands\ActivityLog\V5;

use WPSP\App\Widen\Integrations\ActivityLog\V5\Support\Config;
use WPSP\Funcs;

class CleanActivitylogCommand extends \Spatie\Activitylog\Commands\CleanActivitylogCommand {

	protected $description = 'Clean up old records from the activity log. [WPSP]';

	public function handle(): int {
		if (!$this->confirmToProceed()) {
			return 1;
		}

		$this->comment('[' . Funcs::getRootNamespace() . '] Cleaning activity log...');

		$maxAgeInDays = $this->option('days') ?? Funcs::config('activitylogv5.clean_after_days');

		if (filter_var($maxAgeInDays, FILTER_VALIDATE_INT) === false || (int)$maxAgeInDays < 1) {
			$this->error('The days option must be a positive integer.');

			return 1;
		}

		$amountDeleted = Config::cleanActivityLogAction()->execute(
			(int)$maxAgeInDays,
			$this->argument('log'),
		);

		$this->info("Deleted {$amountDeleted} record(s) from the activity log.");

		$this->comment('All done!');

		return 0;
	}

}