<?php

namespace WPSP\app\Exceptions;

use Illuminate\Support\Facades\Log;
use Throwable;

class ModelNotFoundException extends \Illuminate\Database\Eloquent\ModelNotFoundException {

	/**
	 * Tên model không tìm thấy
	 *
	 * @var string|null
	 */
	protected $modelName = null;

	/**
	 * Mã HTTP status code (404)
	 */
	protected $statusCode = '404';

	/**
	 * Khởi tạo exception
	 *
	 * @param string|null     $modelName Tên model bị lỗi (VD: User, Post, Product)
	 * @param string|null     $message   Thông điệp tùy chỉnh
	 * @param \Throwable|null $previous  Exception trước đó (nếu có)
	 */
	public function __construct(?string $modelName = null, ?string $message = null, ?Throwable $previous = null) {
		$this->modelName = $modelName;

		// Nếu chưa có message, tạo message mặc định
		$message = $message ?? $this->buildDefaultMessage($modelName);

		parent::__construct($message, $previous);
	}

	/**
	 * Tạo message mặc định
	 */
	protected function buildDefaultMessage(?string $modelName): string {
		if ($modelName) {
			return "Không tìm thấy dữ liệu cho {$modelName}.";
		}
		return "Không tìm thấy bản ghi yêu cầu.";
	}

	/**
	 * Ghi log lỗi (nếu cần)
	 */
	public function report(): void {
		Log::warning("ModelNotFoundException: {$this->getMessage()}", [
			'model'   => $this->modelName,
			'url'     => 'url',
			'user_id' => '9999',
		]);
	}

	/**
	 * Tự động render phản hồi khi exception bị ném
	 * Laravel sẽ gọi hàm này nếu không có catch()
	 */
	public function render($request) {
		// Nếu request là API hoặc AJAX → trả JSON
		if ($request->expectsJson()) {
			return response()->json([
				'success' => false,
				'error'   => [
					'type'    => 'ModelNotFoundException',
					'message' => $this->getMessage(),
					'model'   => $this->modelName,
				],
			], $this->statusCode);
		}

		// Nếu request là web → hiển thị view lỗi tùy chỉnh (nếu có)
		if (wpsp_view()->exists('errors.404')) {
			return response()->view('errors.404', [
				'message' => $this->getMessage(),
				'model'   => $this->modelName,
			], $this->statusCode);
		}

		// Nếu không có view 404 → trả text đơn giản
		return response($this->getMessage(), $this->statusCode);
	}

	/**
	 * Lấy tên model bị lỗi (nếu có)
	 */
	public function getModelName(): ?string {
		return $this->modelName;
	}

}