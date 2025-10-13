<?php

namespace WPSP\app\Extras\Instances\ErrorHandler;

use Spatie\Ignition\Config\IgnitionConfig;
use WPSP\Funcs;

class Ignition extends \WPSPCORE\ErrorHandler\Ignition {

	public static ?Ignition $instance = null;

	public static function init() {
		$mainPath = Funcs::instance()->_getMainPath();
		$editor   = Funcs::env('APP_DEBUG_EDITOR', true, 'phpstorm');
		$theme    = Funcs::env('APP_DEBUG_THEME', true, 'auto');
		$ignitionConfigs = new IgnitionConfig(Funcs::config('ignition'));
		static::make()
			->setConfig($ignitionConfigs)
			->applicationPath($mainPath)
			->setEditor($editor)
			->setTheme($theme)
			->register(E_ERROR);
	}

}