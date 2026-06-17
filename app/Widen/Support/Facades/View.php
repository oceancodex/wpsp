<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\View\View as ViewCore;

class View extends ViewCore {

	use InstancesTrait;

	/** @var ViewCore|null */
	public static $instance  = null;

	/**
	 * @return ViewCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setView();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}