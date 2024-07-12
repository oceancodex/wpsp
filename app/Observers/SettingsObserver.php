<?php

namespace WPSP\app\Observers;
use WPSP\app\Models\SettingsModel;

class SettingsObserver {

	public function creating(SettingsModel $setting): void {
		//
	}

	public function created(SettingsModel $setting): void {
		//
	}

	public function updating(SettingsModel $setting): void {
		//
		error_log(print_r($setting, true));
	}

	public function updated(SettingsModel $setting): void {
		//
	}

	public function deleted(SettingsModel $setting): void {
		//
	}

	public function restored(SettingsModel $setting): void {
		//
	}

	public function forceDeleted(SettingsModel $setting): void {
		//
	}

}