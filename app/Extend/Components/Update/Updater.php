<?php

namespace WPSP\app\Extend\Components\Update;

use YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

class Updater {

	public static function init(): ?\YahnisElsts\PluginUpdateChecker\v5p4\Plugin\PluginInfo {

		// Disable SSL verification.
		add_filter('puc_request_info_options-' . config('app.short_name'), function ($options) {
			$options['sslverify'] = false;
			return $options;
		});

		// Change "Check for updates" link text.
		add_filter('puc_manual_check_link-' . \WPSP\Funcs::instance()->getTextDomain(), function($text) {
			return trans('messages.check_for_updates');
		});

		try {
			$updateChecker = PucFactory::buildUpdateChecker(
				config('updater.package_url') ?: \WPSP\Funcs::instance()->getPublicUrl() . '/plugin.json',
				\WPSP\Funcs::instance()->getMainFilePath(),
				\WPSP\Funcs::instance()->getTextDomain(),
			);

			return $updateChecker->requestInfo();
		}
		catch (\Exception $e) {
			return null;
		}

	}

}