<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Support\Facades\Pipeline as PipelineCore;

class Pipeline extends PipelineCore {

	use InstancesTrait;

	/** @var PipelineCore|null */
	public static $instance  = null;

	/**
	 * @return PipelineCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$funcs = Funcs::instance();

			static::$instance = new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[]
			);

			static::$instance->setFacade();
		}

		return static::$instance;
	}

}