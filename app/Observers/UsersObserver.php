<?php

namespace WPSP\App\Observers;
use WPSP\App\Events\UsersCreatedEvent;
use WPSP\App\Instances\Events\Event;
use WPSP\App\Models\UsersModel;

class UsersObserver {

	public function creating(UsersModel $user) {
		//
	}

	public function created(UsersModel $user) {
		Event::instance()->dispatcher()->dispatch(new UsersCreatedEvent($user));
	}

	public function updating(UsersModel $user) {
		//
		error_log(print_r($user, true));
	}

	public function updated(UsersModel $user) {
		//
	}

	public function deleted(UsersModel $user) {
		//
	}

	public function restored(UsersModel $user) {
		//
	}

	public function forceDeleted(UsersModel $user) {
		//
	}

}