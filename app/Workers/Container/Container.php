<?php

namespace WPSP\app\Workers\Container;

use Illuminate\Events\Dispatcher;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Container extends \WPSPCORE\Container {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	public static function instance() {
		if (!static::$instance && class_exists('\Illuminate\Container\Container')) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
				]
			);
			static::$instance = $instance->getContainer();
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public static function bootEvent($container, $useMongoDB = false) {
		\Illuminate\Database\Eloquent\Model::setEventDispatcher(new Dispatcher($container));
		if ($useMongoDB) {
			if (class_exists('MongoDB\Laravel\Eloquent\Model')) {
				\MongoDB\Laravel\Eloquent\Model::setEventDispatcher(new Dispatcher($container));
			}
			elseif (class_exists('Jenssegers\Mongodb\Eloquent\Model')) {
				\Jenssegers\Mongodb\Eloquent\Model::setEventDispatcher(new Dispatcher($container));
			}
		}
	}

}