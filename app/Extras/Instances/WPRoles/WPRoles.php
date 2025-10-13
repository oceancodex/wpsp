<?php

namespace WPSP\app\Extras\Instances\WPRoles;

use WPSP\Funcs;

class WPRoles extends \WPSPCORE\Objects\WPRoles {

	public static ?self $instance = null;

	/*
	 *
	 */

	public function afterInstanceConstruct() {
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