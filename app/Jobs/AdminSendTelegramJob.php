<?php

namespace WPSP\App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class AdminSendTelegramJob implements ShouldQueue {

	use Dispatchable, InteractsWithQueue, Queueable;

	private string $botToken;
	private string $chatId;
	private string $message;

	/**
	 * Create a new job instance.
	 */
	public function __construct(string $message) {
		$this->botToken = '8186507610:AAEhSKu7udC-HaUwuL0Xvy7BTk0yTv_t9dY';
		$this->chatId   = '-4856109024';
		$this->message  = $message;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void {
		try {
			$response = Http::withHeaders([
				'headers' => [
					'Accept' => 'application/json',
				],
			])->post(
				"https://api.telegram.org/bot{$this->botToken}/",
				[
					'chat_id'                  => $this->chatId,
					'text'                     => $this->message,
					'parse_mode'               => 'HTML',
					'disable_web_page_preview' => true,
				]
			);

			$status = $response->getStatusCode();
			if ($status < 200 || $status >= 300) {
				$errorBody = $response->getBody();
				error_log('[AdminSendTelegramJob] HTTP ' . $status . ' - ' . $errorBody);
			}
		}
		catch (\Throwable $e) {
			error_log('[AdminSendTelegramJob] Error: ' . $e->getMessage());
		}
	}

}
