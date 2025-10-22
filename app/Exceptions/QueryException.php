<?php

namespace WPSP\app\Exceptions;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseException;

/**
 * Exception xử lý khi có lỗi trong query SQL.
 */
class QueryException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (500: Internal Server Error)
	 */
	public $statusCode = 500;

	/**
	 * SQL query gây lỗi
	 *
	 * @var string|null
	 */
	protected $sql = null;

	/**
	 * Bindings của query
	 *
	 * @var array
	 */
	protected $bindings = [];

	/**
	 * Khởi tạo exception
	 *
	 * @param string      $sql      SQL query
	 * @param array       $bindings Query bindings
	 * @param string|null $message  Thông điệp lỗi
	 * @param int         $code     Error code
	 */
	public function __construct($sql, $bindings = [], $message = null, $code = 0) {
		$this->sql      = $sql;
		$this->bindings = $bindings;

		// Nếu không có message, lấy lỗi từ $wpdb
		if (!$message) {
			global $wpdb;
			$message = $wpdb->last_error ?: 'Database query error';
		}

		parent::__construct($message, $code);
	}

	/**
	 * Lấy SQL query
	 */
	public function getSql() {
		return $this->sql;
	}

	/**
	 * Lấy query bindings
	 */
	public function getBindings() {
		return $this->bindings;
	}

	/**
	 * Tùy chỉnh cách render Exception
	 */
	public function render() {
		global $wpdb;

		$errorDetails = [
			'message'    => $this->getMessage(),
			'sql'        => $this->sql,
			'last_error' => $wpdb->last_error ?? null,
		];

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			status_header($this->statusCode);

			$response = [
				'success' => false,
				'message' => $this->getMessage(),
				'code'    => $this->statusCode,
			];

			// Chỉ hiển thị chi tiết SQL khi debug mode
			if (Funcs::env('APP_DEBUG', true) == 'true') {
				$response['error'] = [
					'type'     => 'QueryException',
					'sql'      => $this->sql,
					'bindings' => $this->bindings,
					'db_error' => $wpdb->last_error ?? null,
				];
			}

			wp_send_json($response);
			exit;
		}


		// Nếu debug mode, hiển thị chi tiết
		if (Funcs::env('APP_DEBUG', true) !== 'true') {
			echo '<div style="background:white;padding:20px;border:2px solid #d63638;margin:20px;font-family:monospace;">';
			echo '<h2 style="color:#d63638;">QueryException</h2>';
			echo '<p><strong>Message:</strong> ' . esc_html($this->getMessage()) . '</p>';
			echo '<p><strong>SQL:</strong><br><code style="background:#f0f0f1;padding:10px;display:block;overflow-x:auto;">' . esc_html($this->sql) . '</code></p>';
			if (!empty($this->bindings)) {
				echo '<p><strong>Bindings:</strong><br><pre style="background:#f0f0f1;padding:10px;overflow-x:auto;">' . esc_html(print_r($this->bindings, true)) . '</pre></p>';
			}
			if ($wpdb->last_error) {
				echo '<p><strong>Database Error:</strong> ' . esc_html($wpdb->last_error) . '</p>';
			}
			echo '<p><strong>File:</strong> ' . esc_html($this->getFile()) . ':' . $this->getLine() . '</p>';
			echo '</div>';
			exit;
		}

		// Production mode - ẩn chi tiết
		wp_die(
			'<h1>Lỗi cơ sở dữ liệu</h1><p>Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu. Vui lòng thử lại sau.</p>',
			'QueryException',
			[
				'response'  => $this->statusCode,
				'back_link' => true,
			]
		);
	}

	/**
	 * Ghi log lỗi
	 */
	public function report() {
		global $wpdb;

		error_log(sprintf(
			"QueryException: %s\nSQL: %s\nBindings: %s\nDB Error: %s\nFile: %s:%d",
			$this->getMessage(),
			$this->sql,
			json_encode($this->bindings),
			$wpdb->last_error ?? 'None',
			$this->getFile(),
			$this->getLine()
		));
	}

}