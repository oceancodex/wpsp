<?php

namespace WPSP\app\Components\Update;

use YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

class Updater {

	public static function init(): ?\YahnisElsts\PluginUpdateChecker\v5p4\Plugin\PluginInfo {

		// Disable SSL verification.
		add_filter('puc_request_info_options-' . config('app.short_name'), function ($options) {
			$options['sslverify'] = false;
			return $options;
		});

		try {
			$updateChecker = PucFactory::buildUpdateChecker(
				config('updater.package_url') ?: WPSP_PUBLIC_URL . '/plugin.json',
				WPSP_PLUGIN_FILE_PATH,
				WPSP_TEXT_DOMAIN,
			);

			return $updateChecker->requestInfo();
		}
		catch (\Exception $e) {
			return null;
		}

	}

}