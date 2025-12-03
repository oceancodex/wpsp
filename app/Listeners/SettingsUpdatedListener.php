<?php

namespace WPSP\App\Listeners;

use WPSP\App\Events\SettingsUpdatedEvent;
use WPSP\App\Jobs\AdminSendEmailJob;
use WPSP\App\Mail\TestMail;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;

class SettingsUpdatedListener {

	/**
	 * Create the event listener.
	 */
	public function __construct(SettingsModel $settings) {
		//
	}

	public function handle(SettingsUpdatedEvent $event): void {
		// Code here...
		AdminSendEmailJob::dispatch('khanhpkvn@gmail.com', new TestMail('Đã cập nhật settings!'))->onQueue('emails');
		Funcs::notice('SettingsUpdatedListener fired! in: ' . __FILE__);
	}

	public function shouldQueue(): bool {
		return false;
	}

}