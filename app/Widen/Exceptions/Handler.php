<?php

namespace WPSP\App\Widen\Exceptions;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @property \WPSP\Funcs $funcs
 */
class Handler extends \WPSPCORE\App\Exceptions\Handler {

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
		if ($e instanceof \WPSP\App\Exceptions\AuthenticationException) {
			$this->handleAuthenticationException($e);
			exit;
		}

		// AuthorizationException.
		if ($e instanceof \WPSP\App\Exceptions\AuthorizationException || $e instanceof \Illuminate\Auth\Access\AuthorizationException) {
			$this->handleAuthorizationException($e);
			exit;
		}

		// HttpException.
		if ($e instanceof \WPSP\App\Exceptions\HttpException) {
			$this->handleHttpException($e);
			exit;
		}

		// TokenMismatchException.
		if ($e instanceof \Illuminate\Session\TokenMismatchException) {
			setcookie(
				Funcs::config('session.cookie'),
				'',
				time() - 3600,
				Funcs::config('session.path'),
				Funcs::config('session.domain'),
				Funcs::config('session.secure'),
				Funcs::config('session.http_only')
			);
			$this->handleHttpException($e);
			exit;
		}

		// ValidationException -> InvalidDataException.
		if ($e instanceof \Illuminate\Validation\ValidationException) {
//			$this->handleValidationException($e);
			(new \WPSP\App\Exceptions\InvalidDataException($e->getMessage(), 422, $e))->render();
			exit;
		}

		// ModelNotFoundException -> ModelNotFoundException.
		if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
//			$this->handleModelNotFoundException($e);
			(new \WPSP\App\Exceptions\ModelNotFoundException($e->getModel(), $e->getMessage()))->render();
			exit;
		}

		// QueryException.
		if ($e instanceof \WPSP\App\Exceptions\QueryException) {
			$this->handleQueryException($e);
			exit;
		}

		// Nếu có Ignition.
		if (class_exists('\Spatie\Ignition\Ignition')) {
			try {
				$app = $this->funcs->_getApplication();

				// Get configs.
				$app->singleton(
					\Spatie\Ignition\Contracts\ConfigManager::class,
					function() use ($app) {
						return new \WPSPCORE\App\Integrations\Ignition\Contracts\ConfigManager($app);
					}
				);

				// Render.
				\Spatie\Ignition\Ignition::make()
					->shouldDisplayException(true)
					->applicationPath($app->basePath())
					->register()
					->renderException($e);
				exit;
			}
			catch (\Throwable $ignEx) {
				error_log('[WPSP] Ignition threw: ' . $ignEx->getMessage());
				// fallthrough
			}
		}

		// Các exception khác.
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