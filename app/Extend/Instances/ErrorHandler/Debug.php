<?php

namespace WPSP\app\Extend\Instances\ErrorHandler;

class Debug extends \WPSPCORE\ErrorHandler\Debug {

	public static function init(): void {
		static::enable();
	}

}