<?php

namespace WPSP\app\Extras\Instances\Routes;

class MapRoutes {

	public $map = [];

	public static $instance = null;

	/**
	 * @return static
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public function __construct() {}

	public function getMap() {
		return $this->map;
	}

}