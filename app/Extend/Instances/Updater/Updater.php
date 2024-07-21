<?php

namespace WPSP\app\Extend\Instances\Updater;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseUpdater;

class Updater extends BaseUpdater {

	use InstancesTrait;

	public bool    $sslVerify            = false;
//	public ?string $checkForUpdatesLabel = null;
//	public ?string $packageUrl           = null;

	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	protected function afterInstanceConstruct(): void {
//		$this->checkForUpdatesLabel = Funcs::trans('messages.check_for_updates');
//		$this->packageUrl           = Funcs::config('updater.package_url') ?: Funcs::instance()->_getPublicUrl() . '/plugin.json';
	}

	/*
	 *
	 */

	public static function init(): void {
		static::instance()->prepare()->global();
	}

	public static function instance(): ?self {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return static::$instance;
	}

}