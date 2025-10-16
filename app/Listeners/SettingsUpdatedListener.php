<?php

namespace WPSP\app\Listeners;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseInstances;
use WPSPCORE\Events\Contracts\ListenerContract;

class SettingsUpdatedListener extends BaseInstances implements ListenerContract {

	use InstancesTrait;

	public function handle($event, $payload = []) {
		// Code here...
		Funcs::notice('SettingsUpdatedListener fired! in: ' . __FILE__, 'info', true);
//		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r('SettingsUpdatedListener fired! in: ' . __FILE__); echo '</pre>';
	}

	public function shouldQueue(): bool {
		return false;
	}

}