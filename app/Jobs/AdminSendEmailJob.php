<?php

namespace WPSP\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use WPSP\App\Instances\Log\Log;
use WPSP\App\Instances\Mail\Mail;

class AdminSendEmailJob implements ShouldQueue {

	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/** @var string */
	public string $email;

	/** @var \Illuminate\Mail\Mailable */
	public Mailable $mailable;

	/**
	 * Số lần retry job (Laravel default = 1)
	 */
	public int $tries = 3;

	/**
	 * Thời gian tối đa (seconds) cho mỗi lần chạy
	 */
	public int $timeout = 30;

	/**
     * Thời gian backoff (seconds) cho mỗi lần retry
     */
	public int $backoff = 10;

	/**
	 * Create a new job instance.
	 *
	 * @param string                         $email
	 * @param \Illuminate\Mail\Mailable|null $mailable
	 */
	public function __construct(string $email, Mailable $mailable) {
		$this->email    = $email;
		$this->mailable = $mailable;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void {
		try {
			Mail::to($this->email)->send($this->mailable);

			Log::info("SendEmailJob: Mail sent to {$this->email}");
		}
		catch (\Throwable $e) {
			Log::error("SendEmailJob FAILED: {$this->email}. Error: " . $e->getMessage());

			// Ném lại lỗi để Laravel queue xử lý retry
			throw $e;
		}
	}

	/**
	 * Thực thi khi job retry đủ số lần nhưng vẫn fail
	 */
	public function failed(\Throwable $exception): void {
		Log::critical("SendEmailJob permanently failed for {$this->email}. Error: " . $exception->getMessage());
	}

}
