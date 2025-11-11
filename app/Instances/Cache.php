<?php

namespace WPSP\App\Workers\Cache;

use WPSP\App\Workers\Environment\Environment;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @property \WPSPCORE\Cache\Cache|null $instance
 */
class Cache extends \WPSPCORE\Cache\Cache {

	use InstancesTrait;

	private static $instance         = null;
	public         $store            = null;
	public         $connectionParams = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-cache')) {
			return static::instance()->prepare()->global();
		}
		return null;
	}

	/**
	 * @return \WPSPCORE\Cache\Cache|null
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			));
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public static function set($key, $callback) {
		return static::instance()->_set($key, $callback);
	}

	public static function get($key, $callback) {
		return static::instance()->_get($key, $callback);
	}

	public static function delete($key) {
		return static::instance()->_delete($key);
	}

	public static function reset() {
		static::instance()->_reset();
	}

	public static function clear($prefix = null) {
		static::instance()->_clear();
	}

	public static function getItemValue($key) {
		return static::instance()->_getItemValue($key);
	}

}