<?php

namespace WPSP\app\WPSP\Routes;

class RouteMap {

	public $map = [];
	public $mapIdea = [];

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