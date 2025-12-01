<?php

namespace WPSP\App\Listeners;

use WPSP\App\Events\UsersUpdatedEvent;
use WPSP\App\Jobs\SendEmailJob;
use WPSP\App\Mail\TestMail;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;

class UsersUpdatedListener {

	/**
	 * Create the event listener.
	 */
	public function __construct(UsersModel $user) {
		//
	}

	public function handle(UsersUpdatedEvent $event): void {
		// Code here...
		SendEmailJob::dispatch('khanhpkvn@gmail.com', new TestMail('Đã cập nhật user: ' . $event->user->name ?? 'N/A'))->onQueue('emails');
		Funcs::notice('UsersUpdatedListener fired! in: ' . __FILE__, 'info', true);
	}

	public function shouldQueue(): bool {
		return false;
	}

}