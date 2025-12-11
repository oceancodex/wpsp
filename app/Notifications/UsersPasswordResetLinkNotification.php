<?php

namespace WPSP\App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use WPSP\Funcs;

class UsersPasswordResetLinkNotification extends ResetPassword implements ShouldQueue {

	use Queueable;

	/**
	 * Chỉ định mỗi kênh notification sẽ dùng queue nào.
	 *
	 * @return array<string, string>
	 */
	public function viaQueues() {
		return [
			'mail' => 'reset_password_link',
		];
	}

	protected function resetUrl($notifiable) {
		return Funcs::route('RewriteFrontPages', 'auth.reset_password', [
			'token' => $this->token,
			'email' => $notifiable->getEmailForPasswordReset(),
		], true);
	}

}
