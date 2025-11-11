<?php

namespace WPSP\App\Workers\Updater;

use WPSP\App\Workers\Environment\Environment;
use WPSP\Funcs;
use WPSPCORE\Base\BaseUpdater;

/**
 * @property self|null $instance
 */
class Updater extends BaseUpdater {

	public $sslVerify = false;
//	public $checkForUpdatesLabel = null;
//	public $packageUrl           = null;

	/*
	 *
	 */

	public static $instance = null;

	/*
	 *
	 */

	public function afterInstanceConstruct() {
//		$this->checkForUpdatesLabel = class_exists('\WPSPCORE\Translation\Translator') ? Funcs::trans('messages.check_for_updates') : Funcs::trans('Check for updates', true);
//		$this->packageUrl           = Funcs::config('updater.package_url') ?: Funcs::instance()->_getPublicUrl() . '/plugin.json';
	}

	/*
	 *
	 */

	public static function init() {
		return static::instance()->prepare()->global();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs'       => Funcs::instance(),
					'environment' => Environment::instance(),
				]
			));
		}
		return static::$instance;
	}

}