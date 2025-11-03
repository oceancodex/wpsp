<?php

namespace WPSP\app\Workers\Exceptions;

use Illuminate\Validation\ValidationException;
use WPSP\app\Exceptions\InvalidDataException;
use WPSP\app\Exceptions\ModelNotFoundException;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @property \WPSP\Funcs $funcs
 */
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

		// AuthenticationException.
		if ($e instanceof \WPSP\app\Exceptions\AuthenticationException) {
			$this->handleAuthenticationException($e);
			exit;
		}

		// AuthorizationException.
		if ($e instanceof \WPSP\app\Exceptions\AuthorizationException) {
			$this->handleAuthorizationException($e);
			exit;
		}

		// HttpException.
		if ($e instanceof \WPSP\app\Exceptions\HttpException) {
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

		// MappingException -> ORMMappingException.
		if ($e instanceof \Doctrine\ORM\Mapping\MappingException) {
			$this->handleORMMappingException($e);
			exit;
		}

		// QueryException.
		if ($e instanceof \WPSP\app\Exceptions\QueryException) {
			$this->handleQueryException($e);
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