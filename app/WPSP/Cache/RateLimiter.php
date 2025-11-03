<?php

namespace WPSP\app\WPSP\Cache;

use WPSP\app\WPSP\Environment\Environment;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Cache\Adapter;

/**
 * @property \WPSPCORE\RateLimiter\RateLimiter|null $instance
 */
class RateLimiter extends \WPSPCORE\RateLimiter\RateLimiter {

	use InstancesTrait;

	protected $key              = null;
	protected $store            = null;
	protected $connectionParams = null;

	/*
	 *
	 */

	public static $instance = null;

	/*
	 *
	 */

	public function beforeInstanceConstruct() {
		$this->store            = Funcs::config('cache.rate_limiter');
//		$this->key              = $this->request->getClientIp();
//		$this->connectionParams = [];

		if (!$this->adapter) {
			$this->adapter = (new Adapter(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
				]
			))->init($this->store, $this->connectionParams);
		}
	}

	/*
	 *
	 */

	public static function init() {
		return static::instance()->prepare()->global();
	}

	/**
	 * @return \WPSPCORE\RateLimiter\RateLimiter|null
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs'       => Funcs::instance(),
					'request'     => true,
					'environment' => Environment::instance(),
				]
			));
		}
		return static::$instance;
	}

	/*
	 *
	 */

	/**
	 * @return \Symfony\Component\RateLimiter\LimiterInterface
	 */
	public static function get($limiterName = null, $key = null) {
		$instance = static::instance();
		$instance->setKey($key);
		if (!$limiterName) {
			return $instance->prepare()->limiters['default'];
		}
		return $instance->prepare()->limiters[$limiterName];
	}

}