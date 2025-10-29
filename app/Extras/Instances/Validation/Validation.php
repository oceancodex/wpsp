<?php

namespace WPSP\app\Extras\Instances\Validation;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Validation extends \WPSPCORE\Validation\Validation {

	use InstancesTrait;

	/** @var Validation|null  */
	public static $instance = null;

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public static function init() {
		$instance = static::instance();

		try {
			if ($instance->instanceInit) return $instance;

			// Setup language paths first
			$instance->setupLangPaths();

			// Then setup with app Eloquent
			$instance->setupWithAppEloquent();

			// Then init factory
			$instance->initFactory();

			// Then set global.
			$instance->global();

			$instance->instanceInit = true;
		}
		catch (\Exception $e) {}

		return $instance;
	}

	/*
	 *
	 */

	public function setupLangPaths() {
		$langPath = Funcs::instance()->_getResourcesPath('lang');
		if ($langPath && is_dir($langPath)) {
			$this->setLangPaths([$langPath]);
		}
	}

	public function setupWithAppEloquent() {
		// Get Eloquent instance from app
		$eloquent = $this->getAppEloquent();

		if ($eloquent && $eloquent->getCapsule()) {
			// Set database presence verifier using app's Eloquent
			$this->setEloquentConnection($eloquent);
		}
	}

	public function getAppEloquent() {
		// Try to get from Funcs
		$eloquent = Funcs::instance()->_getAppEloquent();
		if ($eloquent) return $eloquent;

		// Try to get from global variable
		$appShortName = Funcs::instance() ? Funcs::instance()->_getAppShortName() : null;
		if ($appShortName) {
			$globalEloquentVar = $appShortName . '_eloquent';
			global ${$globalEloquentVar};

			if (isset(${$globalEloquentVar})) {
				return ${$globalEloquentVar};
			}
		}

		return null;
	}

	public function setEloquentConnection($eloquent) {
		$this->setEloquentForPresenceVerifier($eloquent);
	}

	public function global() {
		$globalValidation = Funcs::instance()->_getAppShortName() . '_validation';
		global ${$globalValidation};
		${$globalValidation} = $this;
	}

}