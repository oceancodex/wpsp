<?php

namespace WPSP\app\Extend\Instances\ErrorHandler;

use WPSP\Funcs;

class Ignition extends \WPSPCORE\ErrorHandler\Ignition {

	public static ?Ignition $instance = null;

	public static function init(): void {
		$mainPath = Funcs::instance()->_getMainPath();
		$editor   = Funcs::env('APP_DEBUG_EDITOR', true, 'phpstorm');
		$theme    = Funcs::env('APP_DEBUG_THEME', true, 'auto');
		static::make()->applicationPath($mainPath)->setEditor($editor)->setTheme($theme)->register();
	}

}