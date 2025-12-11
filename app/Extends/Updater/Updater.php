<?php

namespace WPSP\App\Extends\Updater;

use WPSP\App\Extends\Traits\InstancesTrait;
use WPSPCORE\App\Updater\BaseUpdater;

/**
 * @property self|null $instance
 */
class Updater extends BaseUpdater {

	use InstancesTrait;

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

	public function afterConstruct() {
//		$this->checkForUpdatesLabel = class_exists('\WPSPCORE\Translation\Translator') ? Funcs::trans('messages.check_for_updates') : Funcs::trans('Check for updates', true);
//		$this->packageUrl           = Funcs::config('updater.package_url') ?: Funcs::instance()->_getPublicUrl() . '/plugin.json';
	}

	/*
	 *
	 */

	public static function init() {
		return static::instance()->prepare();
	}

}