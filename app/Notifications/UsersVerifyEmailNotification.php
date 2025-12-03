<?php

namespace WPSP\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use WPSP\Funcs;

class UsersVerifyEmailNotification extends Notification implements ShouldQueue {

	use Queueable;

	/**
	 * Create a new notification instance.
	 */
	public function __construct() {
		//
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable): array {
		return ['mail'];
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function viaQueues(): array {
		return [
			'mail' => 'verify_email'
		];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage {
		$verifyUrl = Funcs::route('RewriteFrontPages', 'verification.verify', ['id' => $notifiable->id, 'hash' => sha1($notifiable->email)], true);
Log::info($verifyUrl);
		return (new MailMessage)
			->subject('Verify Your Email')
			->line('Click the button below to verify your email.')
			->action('Verify Email', $verifyUrl)
			->line('If you did not register, no further action is required.');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(object $notifiable): array {
		return [
			//
		];
	}

}
