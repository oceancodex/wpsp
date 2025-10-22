<?php

namespace WPSP\app\Exceptions;

use WPSP\Funcs;

/**
 * Exception xử lý khi không tìm thấy model.
 */
class ModelNotFoundException extends \Illuminate\Database\Eloquent\ModelNotFoundException {

	protected $modelName = null;
	protected $statusCode = 404;

	public function __construct($modelName = null, $message = null, $code = 0, $previous = null) {
		$this->modelName = $modelName;
		$message = $message ?? $this->buildDefaultMessage($modelName);
		parent::__construct($message, $code, $previous);
	}

	/*
	 *
	 */

	public function report() {
		error_log(sprintf(
			'ModelNotFoundException: %s | Model: %s | URL: %s',
			$this->getMessage(),
			$this->modelName ?? 'Unknown',
			$_SERVER['REQUEST_URI'] ?? 'CLI'
		));
	}

	public function render() {
		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			status_header(404);
			wp_send_json([
				'success' => false,
				'error'   => [
					'type'    => 'ModelNotFoundException',
					'message' => $this->getMessage(),
					'model'   => $this->getModelName(),
				],
			], 404);
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Sử dụng view.
		try {
			echo Funcs::view('errors.model-not-found', [
				'message' => $this->getMessage(),
				'model'   => $this->getModelName(),
			]);
			exit;
		}
		catch (\Exception|\Throwable $e) {}

		// Fallback: Sử dụng wp_die() với status 404
		wp_die(
			'<h1>Model not found</h1><p>' . esc_html($this->getMessage()) . '</p>',
			'404 - Model not found',
			[
				'response'  => 404,
				'back_link' => true,
			]
		);
	}

	/*
	 *
	 */

	public function getModelName() {
		return $this->modelName;
	}

	public function getStatusCode() {
		return $this->statusCode;
	}

	public function buildDefaultMessage($modelName) {
		if ($modelName) {
			return "Không tìm thấy dữ liệu cho {$modelName}.";
		}
		return "Không tìm thấy bản ghi yêu cầu.";
	}

}