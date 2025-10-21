<?php

namespace WPSP\app\Extras\Instances\Cache;

use WPSP\Funcs;
use WPSPCORE\Cache\Adapter;

class RateLimiter extends \WPSPCORE\RateLimiter\RateLimiter {

	protected $key   = null;
	protected $store = null;
	protected         $connectionParams = null;

	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	public function beforeInstanceConstruct() {
		$this->store            = Funcs::config('cache.rate_limiter');
//		$this->key              = $this->request->getClientIp();
//		$this->connectionParams = [];

		$this->adapter = (new Adapter(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv(),
			[
				'prepare_funcs' => true,
			]
		))->init($this->store, $this->connectionParams);
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
					'prepare_funcs' => true,
				]
			));
		}
		return static::$instance;
	}

	/*
	 *
	 */

	/**
	 * @param $limiterName
	 * @param $key
	 *
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