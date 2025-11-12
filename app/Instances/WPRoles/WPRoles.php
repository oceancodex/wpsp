<?php

namespace WPSP\App\Workers\WPRoles;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class WPRoles extends \WPSPCORE\Permissions\WPRoles {

	use InstancesTrait;

	public static ?self $instance = null;

	/*
	 *
	 */

	public function afterConstruct() {
//		$this->textDomain = Funcs::instance()->_getTextDomain();
//		$this->relPath    = Funcs::instance()->_getTextDomain() . '/resources/lang/';
	}

	/*
	 *
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