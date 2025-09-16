<?php

namespace WPSP\app\Extends\Instances\ErrorHandler;

class Debug extends \WPSPCORE\ErrorHandler\Debug {

	public static function init(): void {
		static::enable();
	}

}