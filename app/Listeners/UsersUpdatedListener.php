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
	 * The name of the queue the job should be sent to.
	 */
	public string $queue = 'event';

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
		// Send email.
		SendEmailJob::dispatch('khanhpkvn@gmail.com', new TestMail('Đã cập nhật user: ' . $event->user->name ?? 'N/A'))->onQueue('emails');

		// Chạy queue thì bắn notice ra frontend làm sao đc nữaaa.
//		Funcs::notice('UsersUpdatedListener fired! in: ' . __FILE__, 'info', true);
	}

	/**
	 * Determine whether the listener should be queued.\
	 * Tùy biến thêm logic queue ở đây, khi nào thì Event listener này chạy queue?\
	 * Khi nào thì chạy ngay lập tức mà không cần đưa vào queue?
	 */
	public function shouldQueue(): bool {
		return true;
	}

}