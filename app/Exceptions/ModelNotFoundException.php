<?php

namespace WPSP\app\Exceptions;

use WPSP\Funcs;

/**
 * Exception xử lý khi không tìm thấy model.
 */
class ModelNotFoundException extends \Illuminate\Database\Eloquent\ModelNotFoundException {

	protected $modelName  = null;
	protected $statusCode = 404;

	public function __construct($modelName = null, $message = null, $code = 0, $previous = null) {
		$this->modelName = $modelName;
		if ($code) $this->statusCode = $code;
		$message = $message ?? $this->buildDefaultMessage($modelName);
		parent::__construct($message, $this->statusCode, $previous);
	}

	/*
	 *
	 */

	public function render() {
		status_header(404);

		$message = $this->getMessage();

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (Funcs::wantJson()) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'message' => $message,
				'errors'  => [
					[
						'type'  => 'ModelNotFoundException',
						'model' => $this->getModelName(),
					],
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
				'message' => $message,
				'model'   => $this->getModelName(),
			]);
			exit;
		}
		catch (\Exception $e) {
		}

		// Sử dụng wp_die.
		wp_die(
			'<h1>ERROR: 404 - Không tìm thấy bản ghi</h1><p>' . $message . '</p>',
			'ERROR: 404 - Không tìm thấy bản ghi',
			[
				'response'  => 404,
				'back_link' => true,
			]
		);
	}

	public function report() {
		error_log(sprintf(
			'ModelNotFoundException: %s | Model: %s | URL: %s',
			$this->getMessage(),
			$this->getModelName() ?? 'Unknown',
			$_SERVER['REQUEST_URI'] ?? 'CLI'
		));
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