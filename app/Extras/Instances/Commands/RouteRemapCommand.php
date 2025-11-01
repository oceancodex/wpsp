<?php

namespace WPSP\app\Extras\Instances\Commands;

use WPSP\app\Extras\Instances\Routes\MapRoutes;
use WPSP\Funcs;
use WPSPCORE\Console\Traits\CommandsTrait;

class RouteRemapCommand extends \WPSPCORE\Console\Commands\RouteRemapCommand {

	use CommandsTrait;

	public function customProperties() {
		$this->mapRoutes = MapRoutes::instance();
		$this->funcs = Funcs::instance();
	}

}