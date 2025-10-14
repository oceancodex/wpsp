<?php

namespace WPSP\app\View;

use WPSP\app\Extras\Instances\Auth\Auth;
use WPSP\app\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShare;

class Share extends BaseShare {

	public static ?self $instance = null;

	/*
	 *
	 */

	public function variables() {
		$variables = [];

		try {
			$settings              = SettingsModel::query()->where('key', 'settings')->first();
			$settings              = json_decode($settings['value'] ?? '', true);
			$variables['settings'] = $settings;

			$variables['user'] = Auth::instance()->guard('web')->user() ?? null;

			// Maybe your custom share variables here...
		}
		catch (\Exception|\Throwable $e) {
			Funcs::notice($e->getMessage() . ' <code>(' . __CLASS__ . ')</code>', 'error', true, true);
		}

		$variables['current_request'] = $this->request;
		$variables['wp_user']         = wp_get_current_user();

		// Maybe your custom share variables here...

		return $variables;
	}

	public function inject($view, $variables = []) {

	}

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			static::$instance = new self();
		}
		return static::$instance;
	}

}