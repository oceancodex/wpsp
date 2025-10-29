<?php

namespace WPSP\app\Extras\Instances\Environment;

class Environment extends \WPSPCORE\Environment\Environment {

	public static function init($envDir = null) {
		if (!static::$loaded) {
			static::initEnvironment($envDir);
		}
	}

}