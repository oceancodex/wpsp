<?php

namespace WPSP\app\Extras\Instances\Validation;

use WPSP\app\Traits\InstancesTrait;

class Validation extends \WPSPCORE\Validation\Validation {

	use InstancesTrait;

	private static $instance = null;

	public static function instance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function init() {
		$instance = self::instance();
		$instance->setupWithAppEloquent();
		return $instance;
	}

	protected function setupWithAppEloquent() {
		// Get Eloquent instance from app
		$eloquent = $this->getAppEloquent();

		if ($eloquent && $eloquent->getCapsule()) {
			// Set database presence verifier using app's Eloquent
			$this->setEloquentConnection($eloquent);
		}
	}

	protected function getAppEloquent() {
		// Try to get from Funcs
		if ($this->funcs && method_exists($this->funcs, '_getAppEloquent')) {
			return $this->funcs->_getAppEloquent();
		}

		// Try to get from global variable
		$appShortName = $this->funcs ? $this->funcs->_getAppShortName() : null;
		if ($appShortName) {
			$globalEloquentVar = $appShortName . '_eloquent';
			global ${$globalEloquentVar};

			if (isset(${$globalEloquentVar})) {
				return ${$globalEloquentVar};
			}
		}

		return null;
	}

	protected function setEloquentConnection($eloquent) {
		parent::setEloquentForPresenceVerifier($eloquent);
	}

	public function global() {
		$globalValidation = $this->funcs->_getAppShortName() . '_validation';
		global ${$globalValidation};
		${$globalValidation} = $this;
	}

}