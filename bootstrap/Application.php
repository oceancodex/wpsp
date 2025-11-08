<?php

namespace WPSP\bootstrap;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Throwable;
use ErrorException;
use WPSP\Funcs;

class Application {

	protected static ?FoundationApplication $instance = null;

	/*
	 *
	 */

	public static function init(): ?FoundationApplication {
		return static::instance();
	}

	public static function instance(): ?FoundationApplication {
		if (!static::$instance) {
			$app = FoundationApplication::configure(dirname(__DIR__))
				->withMiddleware(function(Middleware $middleware) {
					// Global middleware (nếu cần)
				})
				->withExceptions(function(Exceptions $exceptions) {
					// Exception config placeholder
				})
				->withProviders()
				->create();

			// Load ENV
			(new LoadEnvironmentVariables)->bootstrap($app);
			static::normalizeEnvPrefix('WPSP_');

			// Load config & facades
			(new LoadConfiguration)->bootstrap($app);
			(new RegisterFacades)->bootstrap($app);
			(new RegisterProviders)->bootstrap($app);

			// Core bindings
			$app->singleton('files', function() {
				return new Filesystem();
			});
			$app->singleton('request', function() {
				return Request::capture();
			});

			$app->boot();

			$viewFactory = $app->make('view');

			$laravelErrorViews = $app->basePath('vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/views');
			if (is_dir($laravelErrorViews)) {
				$viewFactory->addNamespace('errors', $laravelErrorViews);
			}

			// Đăng ký toàn cục error/exception handlers
			static::handleException($app);
			echo '<pre style="background:white;z-index:9999;position:relative">123'; print_r(app()); echo '</pre>'; die();
			static::$instance = $app;
		}

		return static::$instance;
	}

	protected static function normalizeEnvPrefix($prefix) {
		foreach ($_ENV as $key => $value) {
			if (strpos($key, $prefix) === 0) {
				$plain = substr($key, strlen($prefix));
				if (!isset($_ENV[$plain])) $_ENV[$plain] = $value;
				if (!isset($_SERVER[$plain])) $_SERVER[$plain] = $value;
				if (getenv($plain) === false) @putenv("$plain=$value");
			}
		}
	}

	protected static function handleException(FoundationApplication $app) {
		$existsExceptionHandler = set_exception_handler(null);
		set_exception_handler(function(\Throwable $e) use ($app) {
			$handler = new \WPSP\app\Workers\Exceptions\Handler();
			$handler->report($e);
			$handler->render($e);
		});
	}

}