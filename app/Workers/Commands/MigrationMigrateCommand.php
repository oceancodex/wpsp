<?php

namespace WPSP\app\Workers\Commands;

use WPSP\app\Workers\Database\Eloquent;
use WPSPCORE\Console\Traits\CommandsTrait;

class MigrationMigrateCommand extends \WPSPCORE\Console\Commands\MigrationMigrateCommand {

	use CommandsTrait;

	public function customProperties() {
		$this->eloquent  = Eloquent::instance();
	}

}