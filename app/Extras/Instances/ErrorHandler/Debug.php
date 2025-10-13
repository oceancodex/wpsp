<?php

namespace WPSP\app\Extras\Instances\ErrorHandler;

class Debug extends \WPSPCORE\ErrorHandler\Debug {

	public static function init() {
		static::enable();
	}

}