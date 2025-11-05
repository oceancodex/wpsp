<?php

namespace WPSP\app\Jobs;

use Illuminate\Bus\Batchable;
use WPSPCORE\Queue\Concerns\InteractsWithQueue;
use WPSPCORE\Queue\Concerns\Queueable;
use WPSPCORE\Queue\Contracts\ShouldQueue;
use WPSPCORE\Queue\Logger;

class SendEmailJob implements ShouldQueue {

	use Queueable, Batchable, InteractsWithQueue;

	public $tries = 1;

	private string $email;
	private array  $data;

	public function __construct(string $email, array $data = []) {
		$this->email = $email;
		$this->data  = $data;
	}

	public function handle(): void {
		Logger::log('[-] Đang xử lý SendEmailJob cho: ' . $this->email);
		Logger::log('[-] Dữ liệu: ' . json_encode($this->data));
	}

	public function failed(\Throwable $exception): void {
		Logger::log('[X] Lỗi SendEmailJob cho: ' . $this->email);
		Logger::log('[X] Chi tiết lỗi: ' . $exception->getMessage());
	}

}