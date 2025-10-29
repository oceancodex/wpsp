<?php

namespace WPSP\app\Extras\Instances\Commands;

use WPSP\app\Extras\Instances\Routes\MapRoutes;
use WPSPCORE\Console\Traits\CommandsTrait;

class RouteRemapCommand extends \WPSPCORE\Console\Commands\RouteRemapCommand {

	use CommandsTrait;

	public function customProperties() {
		$this->mapRoutes = MapRoutes::instance();
	}

}