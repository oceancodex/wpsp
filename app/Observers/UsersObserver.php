<?php

namespace wpsp\app\Observers;
use WPSP\app\Extras\Instances\Events\Event;
use WPSP\app\Models\UsersModel;

class UsersObserver {

	public function creating(UsersModel $user) {
		//
	}

	public function created(UsersModel $user) {
		Event::dispatcher()->dispatch('users.created', $user);
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