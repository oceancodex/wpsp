<?php

namespace WPSP\app\View;

use WPSP\app\Models\Settings;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShare;

class Share extends BaseShare {

	public function variables(): array {
		$variables = [];
		try {
			$settings = Settings::query()->where('key','settings')->first();
			$settings = json_decode($settings['value'] ?? '', true);
			$variables['settings'] = $settings;
		}
		catch (\Exception $e) {
		}
		$variables['user'] = wp_get_current_user();
		return $variables;
	}

}