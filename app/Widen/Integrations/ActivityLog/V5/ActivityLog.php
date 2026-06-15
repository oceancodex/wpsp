<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5;

use WPSP\App\Widen\Integrations\ActivityLog\V5\Support\PendingActivityLog;
use WPSP\Funcs;

/**
 * @mixin \Spatie\Activitylog\Support\ActivityLogger
 */
class ActivityLog {

	public static $instance = null;

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public function logger(?string $logName = null) {
		$log = Funcs::app(PendingActivityLog::class);

		if ($logName) {
			$log?->useLog($logName);
		}

		return $log?->logger();
	}

	/*
	 *
	 */

	public function __call($method, $parameters) {
		return $this->logger()?->$method(...$parameters);
	}

	public static function __callStatic($method, $parameters) {
		return static::instance()->$method(...$parameters);
	}

}