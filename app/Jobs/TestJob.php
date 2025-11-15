<?php

namespace WPSP\App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class TestJob implements ShouldQueue {

	use Queueable;

	/**
	 * Create a new job instance.
	 */
	public function __construct() {
		//
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void {
		Log::info('TestJob');
	}

}
