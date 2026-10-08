<?php
/**
 * Name: 			Laravel Ignition
 * Description:		Integrate Laravel Ignition.
 * Version:			1.0.0
 * Author:			OceanCodex
 * Requires WP:		6.4
 * Requires WPSP:	13.0
 * Requires PHP:	8.3
 */

namespace WPSP\App\Widen\Integrations\LaravelIgnition;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\Integrations\BaseIntegration;

class LaravelIgnition extends BaseIntegration {

	use InstancesTrait;

	public $activate = true;

	/*
	 *
	 */

//	public function init() {}

	/*
	 *
	 */

	public function handle(\Throwable $e) {
		try {
			$app = $this->funcs->_getApplication();

			// Binds.
			$app->singleton(
				\Spatie\Ignition\Contracts\ConfigManager::class,
				fn() => (new \WPSPCORE\App\Integrations\LaravelIgnition\Contracts\ConfigManager($app))
			);

			$app->singleton(
				\Spatie\Ignition\Ignition::class,
				fn() => (new \WPSPCORE\App\Integrations\LaravelIgnition\Ignition(
					$app->make(\Spatie\FlareClient\Flare::class),
					$app,
					$this->funcs->_getRouteManager())
				)->applicationPath($app->basePath())
			);

			// Resolve.
			$ignition = $app->make(\Spatie\Ignition\Ignition::class);

			// Render.
			$ignition->renderException($e);

			exit;
		}
		catch (\Throwable $ignEx) {
			error_log('['.$this->funcs->_config('app.name').'] Ignition threw: ' . $ignEx->getMessage());
		}
	}

}