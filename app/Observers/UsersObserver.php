<?php

namespace WPSP\App\Observers;
use WPSP\App\Events\UsersUpdatedEvent;
use WPSP\App\Instances\Event\Event;
use WPSP\App\Models\UsersModel;

class UsersObserver {

	public function creating(UsersModel $user) {
		//
	}

	public function created(UsersModel $user) {
		Event::dispatch(new UsersUpdatedEvent($user));
	}

	public function updating(UsersModel $user) {
		//
	}

	public function updated(UsersModel $user) {
		Event::dispatch(new UsersUpdatedEvent($user));
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