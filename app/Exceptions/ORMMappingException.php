<?php

namespace WPSP\App\Exceptions;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\app\Exceptions\BaseException;

class ORMMappingException extends BaseException {

	use InstancesTrait;

	protected $originalException;

	public function __construct($message = "", $code = 500, \Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
		$this->originalException = $previous;
	}

	/**
	 * Render exception response
	 */
	public function render() {
		status_header(500);

		$message = $this->getMessage();

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if ($this->funcs->_expectsJson()) {

			// Debug mode - hiển thị thông tin chi tiết
			if ($this->funcs->env('APP_DEBUG', true) == 'true') {
				wp_send_json([
					'success' => false,
					'data'    => null,
					'errors'  => [
						[
							'type'      => 'ORMMappingException',
							'message'   => $message,
							'file'      => $this->getFile(),
							'line'      => $this->getLine(),
							'exception' => get_class($this->originalException ?: $this),
						]
					],
					'message' => $message,
				], 500);
			}
			// Production mode - ẩn thông tin nhạy cảm
			else {
				wp_send_json([
					'success' => false,
					'data'    => null,
					'errors'  => [
						[
							'type' => 'ORMMappingException',
						]
					],
					'message' => 'Lỗi cấu hình ORM. Vui lòng liên hệ quản trị viên.',
				], 500);
			}
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Debug mode
		if ($this->funcs->env('APP_DEBUG', true) == 'true') {
			// Sử dụng view.
			try {
				echo $this->funcs->view('errors.orm-mapping', [
					'message'   => $message,
					'exception' => get_class($this->originalException ?: $this),
					'file'      => $this->getFile(),
					'line'      => $this->getLine(),
					'trace'     => $this->getTraceAsString(),
				]);
				exit;
			}
			catch (\Throwable $viewException) {
			}

			// Sử dụng wp_die.
			wp_die(
				'<h1>ERROR: 500 - Lỗi cấu hình ORM Mapping</h1>' .
				'<p><strong>Message:</strong> ' . esc_html($message) . '</p>' .
				'<p><strong>File:</strong> ' . esc_html($this->getFile()) . '</p>' .
				'<p><strong>Line:</strong> ' . esc_html($this->getLine()) . '</p>',
				'ERROR: 500 - Lỗi cấu hình ORM Mapping',
				[
					'response'  => 500,
					'back_link' => true,
				]
			);
		}

		// Production mode
		else {
			// Sử dụng view.
			try {
				echo $this->funcs->view('errors.default', [
					'message' => 'Đã xảy ra lỗi hệ thống. Vui lòng thử lại sau hoặc liên hệ quản trị viên.',
				]);
				exit;
			}
			catch (\Throwable $viewException) {
			}

			// Sử dụng wp_die.
			wp_die(
				'<h1>ERROR: 500 - Lỗi hệ thống</h1>' .
				'<p>Đã xảy ra lỗi hệ thống. Vui lòng thử lại sau hoặc liên hệ quản trị viên.</p>',
				'ERROR: 500 - Lỗi hệ thống',
				[
					'response'  => 500,
					'back_link' => true,
				]
			);
		}
	}

	/**
	 * Report exception to log
	 */
	public function report() {
		if ($this->funcs->env('APP_DEBUG', true) == 'true') {
			error_log(sprintf(
				'[ORMMappingException] %s in %s:%s',
				$this->getMessage(),
				$this->getFile(),
				$this->getLine()
			));
		}
	}

}