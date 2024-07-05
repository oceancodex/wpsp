<?php

namespace WPSP\app\Extend\Instances\Cache;

use WPSP\app\Traits\InstancesTrait;

class Cache extends \WPSPCORE\Cache\Cache {

	use InstancesTrait;

	public static ?Cache $instance = null;

	/*
	 *
	 */

	public static function instance(): ?Cache {
		if (!self::$instance) {
			self::$instance = new Cache();
		}
		return self::$instance;
	}

	/*
	 *
	 */

	public static function set($key, $callback) {
		return self::instance()->_set($key, $callback);
	}

	public static function get($key, $callback) {
		return self::instance()->_get($key, $callback);
	}

	public static function delete($key): bool|string {
		return self::instance()->_delete($key);
	}

	public static function reset(): void {
		self::instance()->_reset();
	}

	public static function clear($prefix = null): void {
		self::instance()->_clear();
	}

	public static function getItemValue($key) {
		return self::instance()->_getItemValue($key);
	}

}