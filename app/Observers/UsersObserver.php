<?php

namespace wpsp\app\Observers;
use WPSP\app\Extras\Instances\Events\Event;
use WPSP\app\Models\UsersModel;

class UsersObserver {

	public function creating(UsersModel $setting) {
		//
	}

	public function created(UsersModel $setting) {
	}

	public function updating(UsersModel $setting) {
		//
		error_log(print_r($setting, true));
	}

	public function updated(UsersModel $setting) {
		//
	}

	public function deleted(UsersModel $setting) {
		//
	}

	public function restored(UsersModel $setting) {
		//
	}

	public function forceDeleted(UsersModel $setting) {
		//
	}

}