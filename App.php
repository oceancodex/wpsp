<?php

namespace WPSP;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\View\View;
use WPSP\app\Workers\Exceptions\Handler;
use WPSPCORE\Base\BaseApp;

class App extends BaseApp {

	protected static $instance = null;
	protected ?FoundationApplication $application;

	/*
	 *
	 */

	public static function init(): static {
		return static::instance();
	}

	public static function instance(): static {
		if (!static::$instance || !isset(static::$instance->application) || !static::$instance->application) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			static::$instance->application = static::$instance->application();
		}
		return static::$instance;
	}

	public function application(): FoundationApplication {
		$app = FoundationApplication::configure(__DIR__)
			->withMiddleware()
			->withExceptions()
			->withProviders() // providers.php
			->create();

		static::bootstrap($app);
		static::bindings($app);

		$app->boot();

		static::viewShare($app);
		static::viewCompose($app);
		static::overrideExceptionHandler();

		return $app;
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

	protected static function viewShare(FoundationApplication $app): void {
//		$view = $app->make('view');
//		$view->share([
//			'wp_user' => wp_get_current_user(),
//		]);
	}

	protected static function viewCompose(FoundationApplication $app): void {
		$view = $app->make('view');
		$view->composer('*', function(View $view) {
			$view->with('current_view_name', $view->getName());
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