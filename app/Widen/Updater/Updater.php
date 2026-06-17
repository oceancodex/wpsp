<?php

namespace WPSP\App\Widen\Updater;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\Updater\BaseUpdater;

/**
 * @property self|null $instance
 */
class Updater extends BaseUpdater {

	use InstancesTrait;

	public $sslVerify            = false;	// Whether to verify SSL certificates.
//	public $checkForUpdatesLabel = null;	// The label "Check fo updates" in Plugin list page.
//	public $packageUrl           = null;	// The URL of the metadata file, a GitHub repository, or another supported update source.
//	public $checkPeriod          = 6;		// How often to check for updates (in hours).
//	public $optionName           = '';		// Where to store bookkeeping info about update checks.
//	public $muPluginFile		 = '';		// The plugin filename relative to the mu-plugins directory.

	/*
	 *
	 */

	public function customProperties() {
//		$this->checkForUpdatesLabel = class_exists('\WPSPCORE\Translation\Translator') ? Funcs::trans('messages.check_for_updates') : Funcs::trans('Check for updates', null, true);
//		$this->packageUrl           = Funcs::config('updater.package_url') ?: Funcs::instance()->_getPublicUrl() . '/plugin.json';
	}

}