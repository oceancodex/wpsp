<?php

namespace WPSP\app\Events;

class SettingsUpdatedEvent {

	public $setting;
	public $oldValue;
	public $newValue;
	public $changedBy;

	public function __construct($setting, $oldValue = null, $newValue = null, $changedBy = null) {
		$this->setting   = $setting;
		$this->oldValue  = $oldValue;
		$this->newValue  = $newValue;
		$this->changedBy = $changedBy ?? wp_get_current_user()->ID;
	}

}