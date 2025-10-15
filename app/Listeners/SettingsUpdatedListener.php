<?php

namespace WPSP\app\Listeners;

use WPSP\Funcs;
use WPSPCORE\Events\Contracts\ListenerContract;

class SettingsUpdatedListener implements ListenerContract {

	public function handle($event, $payload = []) {
		// Code here...
		Funcs::notice('SettingsUpdatedListener fired! in: ' . __FILE__, 'info', true);
//		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r('SettingsUpdatedListener fired! in: ' . __FILE__); echo '</pre>';
	}

	public function shouldQueue(): bool {
		return false;
	}

}