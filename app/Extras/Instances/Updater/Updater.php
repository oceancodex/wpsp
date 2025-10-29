<?php

namespace WPSP\app\Extras\Instances\Updater;

use WPSP\app\Extras\Instances\Environment\Environment;
use WPSP\Funcs;
use WPSPCORE\Base\BaseUpdater;

class Updater extends BaseUpdater {

	public $sslVerify = false;
//	public $checkForUpdatesLabel = null;
//	public $packageUrl           = null;

	/*
	 *
	 */

	public static ?self $instance = null;

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
		static::instance()->prepare()->global();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'environment'        => Environment::instance(),
					'validation'         => null,

					'prepare_funcs'      => true,
					'prepare_request'    => false,

					'unset_funcs'        => false,
					'unset_request'      => true,
					'unset_validation'   => true,
					'unset_environment'  => true,

					'unset_extra_params' => true,
				]
			));
		}
		return static::$instance;
	}

}