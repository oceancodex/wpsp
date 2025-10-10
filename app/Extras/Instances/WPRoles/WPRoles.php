<?php

namespace WPSP\app\Extras\Instances\WPRoles;

use WPSP\Funcs;

class WPRoles extends \WPSPCORE\Objects\WPRoles {
	use InstancesTrait;


	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	protected function afterInstanceConstruct(): void {
//		$this->textDomain = Funcs::instance()->_getTextDomain();
//		$this->relPath    = Funcs::instance()->_getTextDomain() . '/resources/lang/';
	}

	/*
	 *
	 */

	public static function instance(): ?self {
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