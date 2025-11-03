<?php

namespace WPSP\app\Workers\Validation;

use WPSP\app\Workers\Database\Eloquent;
use WPSP\app\Workers\Environment\Environment;
use WPSP\Funcs;

class Validation extends \WPSPCORE\Validation\Validation {

	/** @var Validation|null */
	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
				]
			);

			// Setup language paths first
			static::$instance->setupLangPaths();

			// Then setup with app Eloquent
			static::$instance->setupWithAppEloquent();

			// Then init factory
			static::$instance->initFactory();

			// Then set global.
			static::$instance->global();
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public function global() {
		$globalValidation = Funcs::instance()->_getAppShortName() . '_validation';
		global ${$globalValidation};
		${$globalValidation} = $this;
		return $this;
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

		// Try to get from Instance.
		$eloquent = Eloquent::instance();
		if ($eloquent) return $eloquent;

		return null;
	}

	public function setEloquentConnection($eloquent) {
		$this->setEloquentForPresenceVerifier($eloquent);
	}

}