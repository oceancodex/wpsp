<?php

namespace WPSP\app\Extras\Instances\Cache;

use WPSP\app\Extras\Instances\Environment\Environment;
use WPSP\Funcs;

class Cache extends \WPSPCORE\Cache\Cache {

	public $store            = null;
	public $connectionParams = null;

	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	public function beforeInstanceConstruct() {
//		$this->store            = 'redis';
//		$this->connectionParams = [];
	}

	/*
	 *
	 */

	public static function init() {
		static::instance()->prepare()->global();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'environment'        => Environment::instance(),
					'validation'         => null,

					'prepare_funcs'      => true,
					'prepare_request'    => false,

					'unset_funcs'        => false,
					'unset_request'      => true,
					'unset_validation'   => true,
					'unset_environment'  => true,

					'unset_extra_params' => true,
				]
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