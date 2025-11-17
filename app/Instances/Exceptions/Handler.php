<?php

namespace WPSP\App\Instances\Exceptions;

use Illuminate\Validation\ValidationException;
use WPSP\App\Exceptions\InvalidDataException;
use WPSP\App\Exceptions\ModelNotFoundException;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @property \WPSP\Funcs $funcs
 */
class Handler extends \WPSPCORE\Exceptions\Handler {

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

	public function render(\Throwable $e): void {
		parent::render($e);

		// AuthenticationException.
		if ($e instanceof \WPSP\App\Exceptions\AuthenticationException) {
			$this->handleAuthenticationException($e);
			exit;
		}

		// AuthorizationException.
		if ($e instanceof \WPSP\App\Exceptions\AuthorizationException) {
			$this->handleAuthorizationException($e);
			exit;
		}

		// HttpException.
		if ($e instanceof \WPSP\App\Exceptions\HttpException) {
			$this->handleHttpException($e);
			exit;
		}

		// ValidationException -> InvalidDataException.
		if ($e instanceof ValidationException) {
//			$this->handleValidationException($e);
			(new InvalidDataException($e->getMessage(), 422, $e))->render();
			exit;
		}

		// ModelNotFoundException -> ModelNotFoundException.
		if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
//			$this->handleModelNotFoundException($e);
			(new ModelNotFoundException($e->getModel(), $e->getMessage()))->render();
			exit;
		}

		// QueryException.
		if ($e instanceof \WPSP\App\Exceptions\QueryException) {
			$this->handleQueryException($e);
			exit;
		}

		// Các exception khác -> sử dụng Ignition
		$this->fallbackToIgnition($e);
	}

	public function report(\Throwable $e): void {
		parent::report($e);

		if (Funcs::env('WPSP_APP_DEBUG') == 'true') {
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