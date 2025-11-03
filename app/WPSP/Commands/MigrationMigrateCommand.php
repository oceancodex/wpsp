<?php

namespace WPSP\app\WPSP\Commands;

use WPSP\app\WPSP\Database\Eloquent;
use WPSPCORE\Console\Traits\CommandsTrait;

class MigrationMigrateCommand extends \WPSPCORE\Console\Commands\MigrationMigrateCommand {

	use CommandsTrait;

	public function customProperties() {
		$this->eloquent  = Eloquent::instance();
	}

}