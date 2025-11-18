<?php

namespace WPSP\App\Instances\ErrorHandler;

class Debug extends \WPSPCORE\ErrorHandler\Debug {

	public static function init() {
		static::enable();
		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
	}

}