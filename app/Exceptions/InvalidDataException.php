<?php

namespace WPSP\app\Exceptions;

use Exception;
use WPSP\Funcs;

class InvalidDataException extends Exception {

	public function render() {
		Funcs::notice(
			'<strong>' . Funcs::trans('Invalid Data', true) . ':</strong> ' . $this->getMessage(),
			'error',
			!class_exists('\WPSPCORE\View\Blade')
		);

		$handler = new Handler();
		$handler->redirectBack(['error' => 'invalid_data']);
	}

}