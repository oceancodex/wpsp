<?php

namespace WPSP\app\Extras\Instances\Container;

class Container {

	public static $instance = null;

	public static function instance() {
		if (static::$instance === null) {
			static::$instance = \Illuminate\Container\Container::getInstance();
		}
		return static::$instance;
	}

}