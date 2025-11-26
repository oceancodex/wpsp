<?php

namespace WPSP\App\Instances\Routes;

class RouteManager extends \WPSPCORE\Routes\RouteManager {

	public static ?RouteManager $instance = null;

	public static function instance(): ?RouteManager {
		if (!static::$instance) {
			static::$instance = new static();
		}
		return static::$instance;
	}

}