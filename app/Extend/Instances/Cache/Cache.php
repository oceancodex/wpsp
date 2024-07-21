<?php

namespace WPSP\app\Extend\Instances\Cache;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;

class Cache extends \WPSPCORE\Cache\Cache {

	use InstancesTrait;

	public ?string $store            = null;
	public ?array  $connectionParams = null;

	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	protected function beforeInstanceConstruct(): void {
//		$this->store            = 'redis';
//		$this->connectionParams = [];
	}

	/*
	 *
	 */

	public static function init(): void {
		static::instance()->prepare()->global();
	}

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

	public static function reset(): void {
		static::instance()->_reset();
	}

	public static function clear($prefix = null): void {
		static::instance()->_clear();
	}

	public static function getItemValue($key) {
		return static::instance()->_getItemValue($key);
	}

}