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
	public static function wpspInstance() {
		if (static::$instance === null) {
			$funcs = Funcs::instance();

			$instance = new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[]
			);

			$instance->setFacade();
			static::$instance = $instance;
		}

		return static::$instance;
	}

}