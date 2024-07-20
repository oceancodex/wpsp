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

	protected function beforeInstanceConstruct(): void {
//		$this->store            = 'redis';
//		$this->connectionParams = [];
	}

	/*
	 *
	 */

	public static function init(): void {
		self::instance()->prepare()->global();
	}

	public static function instance(): ?self {
		if (!self::$instance) {
			self::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
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

	public static function delete($key) {
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