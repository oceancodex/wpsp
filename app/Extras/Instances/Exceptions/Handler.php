<?php

namespace WPSP\app\Extras\Instances\Exceptions;

use Illuminate\Validation\ValidationException;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Handler extends \WPSPCORE\Validation\Handler {

	use InstancesTrait;

	public $dontReport = [
		//
	];

	public $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/*
	 *
	 */

	public function render(\Throwable $e) {
		parent::render($e);

		// ValidationException -> JSON hoặc redirect
		if ($e instanceof ValidationException) {
			$this->handleValidationException($e);
			exit;
		}

		// QueryException -> Database error
		if ($e instanceof \WPSP\app\Exceptions\QueryException) {
			$this->handleQueryException($e);
			exit;
		}

		// ModelNotFoundException -> 404 response
		if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
			$this->handleModelNotFoundException($e);
			exit;
		}

		// AuthorizationException -> 403 response
		if ($e instanceof \WPSP\app\Exceptions\AuthorizationException) {
			$this->handleAuthorizationException($e);
			exit;
		}

		// AuthenticationException -> 401 response
		if ($e instanceof \WPSP\app\Exceptions\AuthenticationException) {
			$this->handleAuthenticationException($e);
			exit;
		}

		// HttpException -> Custom HTTP response
		if ($e instanceof \WPSP\app\Exceptions\HttpException) {
			$this->handleHttpException($e);
			exit;
		}

		// Các exception khác -> sử dụng Ignition
		$this->fallbackToIgnition($e);
	}

	public function report(\Throwable $e) {
		parent::report($e);

		if (Funcs::env('APP_DEBUG', true) == 'true') {
			error_log(sprintf(
				'[%s] %s in %s:%s',
				get_class($e),
				$e->getMessage(),
				$e->getFile(),
				$e->getLine()
			));
		}
	}

}