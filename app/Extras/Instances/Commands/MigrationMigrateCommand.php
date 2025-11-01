<?php

namespace WPSP\app\Extras\Instances\Commands;

use WPSP\app\Extras\Instances\Database\Eloquent;
use WPSPCORE\Console\Traits\CommandsTrait;

class MigrationMigrateCommand extends \WPSPCORE\Console\Commands\MigrationMigrateCommand {

	use CommandsTrait;

	public function customProperties() {
		$this->eloquent  = Eloquent::instance();
	}

}