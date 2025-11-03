<?php

namespace WPSP\app\WPSP\Commands;

use WPSP\app\WPSP\Routes\RouteMap;
use WPSP\Funcs;
use WPSPCORE\Console\Traits\CommandsTrait;

class RouteRemapCommand extends \WPSPCORE\Console\Commands\RouteRemapCommand {

	use CommandsTrait;

	public function customProperties() {
		$this->routeMap = RouteMap::instance();
		$this->funcs = Funcs::instance();
	}

}