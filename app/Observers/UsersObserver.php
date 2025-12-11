<?php

namespace WPSP\App\Observers;
use WPSP\App\Events\UsersUpdatedEvent;
use WPSP\App\Extends\Support\Facades\Event;
use WPSP\App\Models\UsersModel;

class UsersObserver {

	public function creating(UsersModel $user) {
		//
	}

	public function created(UsersModel $user) {
		//
	}

	public function updating(UsersModel $user) {
		//
	}

	public function updated(UsersModel $user) {
		// Nếu đây chỉ là xác thực email thì không cần bắn event.
		if ($user->wasChanged('email_verified_at')) {
			return;
		}

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