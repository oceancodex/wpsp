<?php

namespace WPSP\app\Observers;
use WPSP\app\Models\SettingsModel;

class SettingsObserver {

	public function creating(SettingsModel $setting) {
		//
	}

	public function created(SettingsModel $setting) {
		//
	}

	public function updating(SettingsModel $setting) {
		//
		error_log(print_r($setting, true));
	}

	public function updated(SettingsModel $setting) {
		//
	}

	public function deleted(SettingsModel $setting) {
		//
	}

	public function restored(SettingsModel $setting) {
		//
	}

	public function forceDeleted(SettingsModel $setting) {
		//
	}

}