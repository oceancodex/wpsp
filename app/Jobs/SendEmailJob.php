<?php

namespace WPSP\App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use WPSPCORE\Base\BaseJob;
use WPSPCORE\Queue\Logger;
use WPSPCORE\Queue\Concerns\Dispatchable;

class SendEmailJob extends BaseJob implements ShouldQueue {

	use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Dữ liệu email (ví dụ: người nhận, tiêu đề, nội dung, v.v.)
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Số lần thử lại tối đa (mặc định: 3)
	 *
	 * @var int
	 */
	public $tries = 1;

	/**
	 * Thời gian chờ giữa các lần retry (tính bằng giây)
	 *
	 * @var int
	 */
//	public $backoff = 60;

	/**
	 * TTL (Time To Live) tối đa — sau khoảng thời gian này job sẽ bị loại bỏ.
	 *
	 * @var int|null
	 */
//	public $timeout = 120;

	/**
	 * Tên queue mà job sẽ được đẩy vào.
	 *
	 * @var string|null
	 */
//	public $queue = 'emails';

	/**
	 * Tên connection queue (nếu dùng Redis, database, v.v.)
	 *
	 * @var string|null
	 */
//	public $connection = 'redis';

	/**
	 * Khởi tạo job.
	 *
	 * @param array $data
	 *
	 * @return void
	 */
	public function __construct(array $data) {
		$this->data = $data;

		// Ví dụ: Delay job 10 giây trước khi xử lý
//		$this->delay(now()->addSeconds(10));
	}

	/**
	 * Xử lý job.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function handle(): void {
		Logger::log('[-] Đang xử lý SendEmailJob cho: ' . $this->data['email']);
		Logger::log('[-] Dữ liệu: ' . json_encode($this->data));
	}

	/**
	 * Xử lý khi job thất bại.
	 *
	 * @param \Throwable $exception
	 *
	 * @return void
	 */
	public function failed(\Throwable $exception): void {
		Logger::log('[X] Lỗi SendEmailJob cho: ' . $this->data['email']);
		Logger::log('[X] Chi tiết lỗi: ' . $exception->getMessage());
	}

}