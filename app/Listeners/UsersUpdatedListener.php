<?php

namespace WPSP\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\RateLimited;
use WPSP\App\Events\UsersUpdatedEvent;
use WPSP\App\Jobs\SendEmailJob;
use WPSP\App\Mail\TestMail;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;

class UsersUpdatedListener implements ShouldQueue {

	/**
	 * Create the event listener.
	 */
	public function __construct(UsersModel $user) {
		//
	}

	/**
	 * Handle the event.
	 */
	public function handle(UsersUpdatedEvent $event): void {
		// Code here...
		SendEmailJob::dispatch('khanhpkvn@gmail.com', new TestMail('Đã cập nhật user: ' . $event->user->name ?? 'N/A'))->onQueue('emails');
		Funcs::notice('UsersUpdatedListener fired! in: ' . __FILE__, 'info', true);
	}

	/**
	 * Determine whether the listener should be queued.
	 */
	public function shouldQueue(): bool {
		return true;
	}

}