<?php

namespace WPSP\app\Jobs;

use WPSPCORE\Queue\Concerns\Queueable;
use WPSPCORE\Queue\Contracts\ShouldQueue;
use WPSPCORE\Queue\Logger;

class FailingJob implements ShouldQueue {

	use Queueable;

	public $tries = 1;

	private string $email;

	public function __construct(string $email = '') {
		$this->email = $email;
	}

	public function handle(): void {
		Logger::info('Processing FailingJob for: ' . $this->email);
		throw new \Exception('Intentional test error from FailingJob');
	}

	public function failed(\Throwable $exception): void {
		Logger::error('FailingJob failed for: ' . $this->email);
		Logger::error('Error: ' . $exception->getMessage());
	}

}