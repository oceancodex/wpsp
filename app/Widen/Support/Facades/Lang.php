<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Lang\Lang as LangCore;

class Lang extends LangCore {

	use InstancesTrait;

	/** @var LangCore|null */
	public static $instance  = null;

	/**
	 * @return LangCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setLang();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}