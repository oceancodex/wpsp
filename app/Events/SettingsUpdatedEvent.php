<?php

namespace WPSP\app\Events;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseInstances;

class SettingsUpdatedEvent extends BaseInstances {

	use InstancesTrait;

	public $setting;
	public $oldValue;
	public $newValue;
	public $changedBy;

	public function __construct($setting, $oldValue = null, $newValue = null, $changedBy = null) {
		parent::__construct();

		$this->setting   = $setting;
		$this->oldValue  = $oldValue;
		$this->newValue  = $newValue;
		$this->changedBy = $changedBy ?? wp_get_current_user()->ID;
	}

}