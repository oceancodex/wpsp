<?php

namespace WPSP\app\Extras\Instances\Database;

use WPSP\app\Extras\Instances\Environment\Environment;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Migration extends \WPSPCORE\Migration\Migration {

	use InstancesTrait;

	public static $instance = null;

	/**
	 * @return null|static
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs'       => Funcs::instance(),
//					'eloquent'    => Eloquent::instance(),
//					'environment' => Environment::instance(),
				]
			));

			// Chỉ khi cần mới gắn Eloquent, tránh vòng lặp vô hạn.
//			static::$instance->set('eloquent', Eloquent::instance());

			static::$instance->global();
		}
		return static::$instance;
	}

	public static function init() {
		return static::instance();
	}

}