<?php

namespace WPSP\app\Extend\Instances\Cache;

use Symfony\Component\RateLimiter\LimiterInterface;
use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Cache\Adapter;

class RateLimiter extends \WPSPCORE\Cache\RateLimiter {

	use InstancesTrait;

	protected ?string $key              = null;
	protected ?string $store            = null;
	protected ?array  $connectionParams = null;

	/*
	 *
	 */

	protected function beforeInstanceConstruct(): void {
		$this->store            = Funcs::config('cache.rate_limiter');
//		$this->key              = $this->request->getClientIp();
//		$this->connectionParams = [];

		$this->adapter = (new Adapter(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv()
		))->init($this->store, $this->connectionParams);
	}

	/*
	 *
	 */

	public static function init(): void {
		self::instance()->prepare()->global();
	}

	public static function instance(): ?RateLimiter {
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

	public static function get($limiterName = null, $key = null): LimiterInterface {
		$instance = self::instance();
		$instance->setKey($key);
		if (!$limiterName) {
			return $instance->prepare()->limiters['default'];
		}
		return $instance->prepare()->limiters[$limiterName];
	}

}