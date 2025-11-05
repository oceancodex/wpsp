<?php

namespace WPSP\app\Jobs;

use Illuminate\Bus\Batchable;
use WPSPCORE\Queue\Concerns\Queueable;
use WPSPCORE\Queue\Contracts\ShouldQueue;
use WPSPCORE\Queue\Logger;

class FailingJob implements ShouldQueue {

	use Queueable, Batchable;

	public $tries = 1;

	private string $email;

	public function __construct(string $email = '') {
		$this->email = $email;
	}

	public function handle(): void {
		Logger::log('[-] handle() > Đang xử lý FailingJob cho: ' . $this->email);
		sleep(10);
		throw new \Exception('Thử nghiệm lỗi FailingJob');
	}

	public function failed(\Throwable $exception): void {
		Logger::log('[X] failed() > Lỗi FailingJob cho: ' . $this->email);
		Logger::log('[X] failed() > Chi tiết lỗi: ' . $exception->getMessage());
	}

}