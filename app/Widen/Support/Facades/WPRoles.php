<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\WPRoles\WPRoles as WPRolesCore;

class WPRoles extends WPRolesCore {

	use InstancesTrait;

	/** @var WPRolesCore|null */
	public static $instance  = null;

	/**
	 * @return WPRolesCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return static::$instance;
	}

}