<?php

namespace WPSP\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use WPSP\Funcs;

/**
 * Notification gửi email xác thực tài khoản cho người dùng.
 * Thông báo này được đưa vào queue (ShouldQueue) và đẩy sang queue tên "verify_email".
 */
class UsersVerifyEmailNotification extends Notification implements ShouldQueue {

	// Trait Queueable cho phép notification sử dụng queue
	use Queueable;

	/**
	 * Khởi tạo Notification.
	 * Ở đây không cần truyền dữ liệu gì thêm, nên để trống.
	 */
	public function __construct() {
		//
	}

	/**
	 * Xác định các kênh gửi notification.
	 * Ở đây chỉ gửi qua email.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable) {
		// Chỉ dùng kênh "mail"
		return ['mail'];
	}

	/**
	 * Chỉ định mỗi kênh notification sẽ dùng queue nào.
	 *
	 * @return array<string, string>
	 */
	public function viaQueues() {
		return [
			'mail' => 'verify_email'
		];
	}

	/**
	 * Tạo nội dung email gửi đến người dùng.
	 * Bao gồm đường dẫn xác thực sử dụng route frontend tùy chỉnh.
	 *
	 * @param  object $notifiable  Đối tượng người dùng nhận email
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail(object $notifiable) {

		// Tạo URL xác thực email, gồm id người dùng và hash email.
		// Funcs::route() có thể là hàm custom để build URL theo cấu trúc frontend của bạn.
		$verifyUrl = Funcs::route('RewriteFrontPages', 'verification.verify', [
			'id' => $notifiable->id,
			'hash' => sha1($notifiable->email)
		], true);

		// Xây dựng email message
		return (new MailMessage)
			->subject('Verify Your Email')                  // Tiêu đề email
			->line('Click the button below to verify your email.') // Nội dung hướng dẫn
			->action('Verify Email', $verifyUrl)            // Nút bấm dẫn đến URL xác thực
			->line('If you did not register, no further action is required.'); // Dòng thông báo phụ
	}

	/**
	 * Chuyển nội dung notification sang dạng array.
	 * Không dùng, nhưng ứng dụng yêu cầu implement.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(object $notifiable) {
		return [
			//
		];
	}

}