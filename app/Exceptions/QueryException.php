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
	public $code = 500;

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
			$message = $wpdb->last_error ?: 'QueryException';
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
		status_header($this->code);

		global $wpdb;

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (Funcs::wantsJson()) {

			// Debug mode.
			if (Funcs::isDebug()) {
				wp_send_json([
					'success' => false,
					'data'    => null,
					'errors'  => [
						[
							'type'     => 'QueryException',
							'sql'      => $this->sql,
							'bindings' => $this->bindings,
							'error'    => $wpdb->last_error ?? null,
						],
					],
					'message' => $this->getMessage(),
				], 500);
			}

			// Production mode.
			else {
				wp_send_json([
					'success' => false,
					'data'    => null,
					'errors'  => [
						[
							'type'  => 'QueryException',
							'error' => $wpdb->last_error ?? null,
						],
					],
					'message' => $this->getMessage(),
				], 500);
			}

			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Debug mode.
		if (Funcs::isDebug()) {
			// Sử dụng view.
			try {
				echo Funcs::view('errors.query', [
					'type'     => 'QueryException',
					'message'  => $this->getMessage(),
					'sql'      => $this->sql ?? null,
					'bindings' => $this->bindings ?? [],
					'error'    => $wpdb->last_error ?? null,
				]);
				exit;
			}
			catch (\Throwable $viewException) {
			}

			// Sử dụng wp_die.
			wp_die(
				'<h1>ERROR: 500 - Lỗi truy vấn cơ sở dữ liệu</h1><p>' . $this->getMessage() . '</p>',
				'ERROR: 500 - Lỗi truy vấn cơ sở dữ liệu',
				[
					'response'  => 500,
					'back_link' => true,
				]
			);
		}

		// Production mode.
		else {
			// Sử dụng wp_die.
			wp_die(
				'<h1>ERROR: 500 - Lỗi truy vấn cơ sở dữ liệu</h1><p>' . $this->getMessage() . '</p>',
				'ERROR: 500 - Lỗi truy vấn cơ sở dữ liệu',
				[
					'response'  => 500,
					'back_link' => true,
				]
			);
		}
	}

	/**
	 * Tùy chỉnh cách báo cáo lỗi. Ví dụ: Ghi lại nhật ký lỗi.
	 */
	public function report() {
		global $wpdb;
		error_log(sprintf(
			"QueryException: %s\n- Error: %s\n- SQL: %s\n- Bindings: %s\n- File: %s:%d",
			$this->getMessage(),
			$wpdb->last_error ?? 'None',
			$this->sql,
			json_encode($this->bindings),
			$this->getFile(),
			$this->getLine()
		));
	}

}