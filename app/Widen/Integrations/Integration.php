<?php

namespace WPSP\App\Widen\Integrations;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\Integrations\Integration as IntegrationCore;

class Integration extends IntegrationCore {

	use InstancesTrait;

	public $autoIntegrationPackages = false;

	/*
	 *
	 */

	public function specificIntegrationPackages() {
		return [
//			\WPSP\App\Widen\Integrations\LaravelDebugbar\LaravelDebugbar::class,
		];
	}

	/*
	 *
	 */

	public function register() {
		if ($this->autoIntegrationPackages) {
			$this->registerAllIntegrationPackages(__DIR__);
		}
		else {
			$this->registerSpecificIntegrationPackages($this->specificIntegrationPackages());
		}
	}

	public function autoIntegrationPackages() {
		$this->registerAllIntegrationPackages(__DIR__);
	}

}