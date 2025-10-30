<?php

namespace WPSP\app\Extras\Instances\Environment;

class Environment extends \WPSPCORE\Environment\Environment {

	public static $instance = null;

	public static function init($envDir = null) {
		if (!static::$instance) {
			static::$instance = (new static())->load($envDir);
		}
		return static::$instance;
	}

	public static function instance() {
		return static::$instance;
	}

}