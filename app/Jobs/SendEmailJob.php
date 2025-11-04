<?php

namespace WPSP\app\Jobs;

use Illuminate\Bus\Batchable;
use WPSPCORE\Queue\Concerns\Queueable;
use WPSPCORE\Queue\Contracts\ShouldQueue;
use WPSPCORE\Queue\Logger;

class SendEmailJob implements ShouldQueue {

	use Queueable, Batchable;

	public $tries = 1;

	private string $email;
	private array  $data;

	public function __construct(string $email, array $data = []) {
		$this->email = $email;
		$this->data  = $data;
	}

	public function handle(): void {
		Logger::info('Processing SendEmailJob for: ' . $this->email);
		Logger::info('Data: ' . json_encode($this->data));
	}

	public function failed(\Throwable $exception): void {
		Logger::error('SendEmailJob failed for: ' . $this->email);
		Logger::error('Error: ' . $exception->getMessage());
	}

}