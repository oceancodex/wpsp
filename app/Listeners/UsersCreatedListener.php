<?php

namespace WPSP\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\RateLimited;
use WPSP\App\Events\UsersCreatedEvent;
use WPSP\App\Jobs\AdminSendEmailJob;
use WPSP\App\Mail\TestMail;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;

class UsersCreatedListener implements ShouldQueue {

	/**
	 * The name of the queue the job should be sent to.
	 */
	public $queue = 'event';

	/**
	 * Create the event listener.
	 */
	public function __construct(UsersModel $user) {
		//
	}

	/**
	 * Handle the event.
	 */
	public function handle(UsersCreatedEvent $event) {
		// Send email sử dụng Job.
		AdminSendEmailJob::dispatch('khanhpkvn@gmail.com', new TestMail('Đã có user mới đăng ký: ' . $event->user->name ?? 'N/A'))->onQueue('emails');

		// Chạy queue thì bắn notice ra frontend làm sao đc nữaaa.
//		Funcs::notice('UsersUpdatedListener fired! in: ' . __FILE__, 'info', true);
	}

	/**
	 * Determine whether the listener should be queued.\
	 * Tùy biến thêm logic queue ở đây, khi nào thì Event listener này chạy queue?\
	 * Khi nào thì chạy ngay lập tức mà không cần đưa vào queue?
	 */
	public function shouldQueue() {
		return true;
	}

}