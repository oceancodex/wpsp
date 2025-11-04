<?php

namespace WPSP\app\Workers\Container;

use Illuminate\Events\Dispatcher;

class Container {

	public static $instance = null;

	public static function instance() {
		if (!static::$instance && class_exists('\Illuminate\Container\Container')) {
			static::$instance = \Illuminate\Container\Container::getInstance();
		}
		return static::$instance;
	}

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