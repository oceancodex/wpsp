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
use WPSP\app\Workers\Exceptions\Handler;
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
				->withMiddleware()
				->withExceptions()
				->withProviders() // providers.php
				->create();
			static::bootstrap($app);
			static::bindings($app);
			$app->boot();
			static::overrideExceptionHandler();
			static::$instance = $app;
		}
		return static::$instance;
	}

	/*
	 *
	 */

	protected static function bootstrap(FoundationApplication $app): void {
		// Load ENV
		(new LoadEnvironmentVariables)->bootstrap($app);
		static::normalizeEnvPrefix(Funcs::PREFIX_ENV);

		// Load config & facades
		(new LoadConfiguration)->bootstrap($app);
		(new RegisterFacades)->bootstrap($app);
		(new RegisterProviders)->bootstrap($app);
	}

	protected static function bindings(FoundationApplication $app): void {
		$app->singleton('files', function() {
			return new Filesystem();
		});
		$app->singleton('request', function() {
			return Request::capture();
		});
	}

	/*
	 *
	 */

	protected static function overrideExceptionHandler(): void {
		$existsExceptionHandler = get_exception_handler();

		if ($existsExceptionHandler instanceof Handler) {
			return;
		}

		set_exception_handler(function(\Throwable $e) {
			$handler = new Handler();
			$handler->report($e);
			$handler->render($e);
		});
	}

	protected static function normalizeEnvPrefix($prefix): void {
		foreach ($_ENV as $key => $value) {
			if (strpos($key, $prefix) === 0) {
				$plain = substr($key, strlen($prefix));
				if (!isset($_ENV[$plain])) $_ENV[$plain] = $value;
				if (!isset($_SERVER[$plain])) $_SERVER[$plain] = $value;
				if (getenv($plain) === false) @putenv("$plain=$value");
			}
		}
	}

}