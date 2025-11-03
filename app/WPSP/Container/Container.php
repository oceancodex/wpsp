<?php

namespace WPSP\app\WPSP\Container;

class Container {

	public static $instance = null;

	public static function instance() {
		if (static::$instance === null && class_exists('\Illuminate\Container\Container')) {
			static::$instance = \Illuminate\Container\Container::getInstance();
		}
		return static::$instance;
	}

}