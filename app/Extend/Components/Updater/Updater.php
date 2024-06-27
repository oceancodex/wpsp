<?php

namespace WPSP\app\Extend\Components\Updater;

use WPSP\Funcs;
use YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

class Updater {

	public static function init(): ?\YahnisElsts\PluginUpdateChecker\v5p4\Plugin\PluginInfo {

		// Disable SSL verification.
		add_filter('puc_request_info_options-' . Funcs::instance()->_getTextDomain(), function ($options) {
			$options['sslverify'] = false;
			return $options;
		});

		// Change "Check for updates" link text.
		add_filter('puc_manual_check_link-' . Funcs::instance()->_getTextDomain(), function($text) {
			return Funcs::trans('messages.check_for_updates');
		});

		try {
			$updateChecker = PucFactory::buildUpdateChecker(
				Funcs::config('updater.package_url') ?: Funcs::instance()->_getPublicUrl() . '/plugin.json',
				Funcs::instance()->_getMainFilePath(),
				Funcs::instance()->_getTextDomain(),
			);

			return $updateChecker->requestInfo();
		}
		catch (\Exception $e) {
			return null;
		}

	}

}