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

	public function customProperties(): void {
//		$this->checkForUpdatesLabel = Funcs::trans('messages.check_for_updates');
//		$this->packageUrl           = Funcs::config('updater.package_url') ?: Funcs::instance()->_getPublicUrl() . '/plugin.json';
	}

}