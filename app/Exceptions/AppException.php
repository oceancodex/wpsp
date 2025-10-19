<?php

namespace WPSP\app\Exceptions;

use Exception;
use WPSP\Funcs;

class AppException extends Exception {

	/**
	 * Report the exception.
	 *
	 * @return bool|null
	 */
	public function report() {
		// Custom reporting logic
		return false;
	}

	/**
	 * Render the exception as an HTTP response.
	 *
	 * @return void
	 */
	public function render() {
		Funcs::notice(
			$this->getMessage(),
			'error',
			!class_exists('\WPSPCORE\View\Blade')
		);

		$handler = new Handler();
		$handler->redirectBack(['error' => 'app']);
	}

}