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
use WPSP\App\Instances\Auth\Auth;
use WPSPCORE\Base\BaseApp;

class App extends BaseApp {

	protected static                 $instance    = null;
	protected ?FoundationApplication $application = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	/**
	 * @return null|static
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);

			$instance->application = $instance->application();

			$instance->viewShare();
			$instance->viewCompose();

			static::$instance = $instance;

			static::overrideExceptionHandler();
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public function application(): FoundationApplication {
		if ($this->application) return $this->application;

		$app = FoundationApplication::configure(__DIR__)
			->withMiddleware(function(Middleware $middleware) {
				// Global middleware (nếu cần)
			})
			->withExceptions(function(Exceptions $exceptions) {
				// Exception config placeholder
			})
			->withMiddleware(function(\Illuminate\Foundation\Configuration\Middleware $middleware) {
				$middleware->append(\Illuminate\Session\Middleware\StartSession::class);
			})
			->withProviders() // providers.php
			->create();

		static::bootstrap($app);
		static::bindings($app);

		$app->boot();

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
		$app->singleton('session', function($app) {
			$connection = $app['db']->connection();
			$table      = 'sessions';
			$minutes    = 120;
			$handler    = new \Illuminate\Session\DatabaseSessionHandler($connection, $table, $minutes, $app);
			return new \Illuminate\Session\Store('wpsp-session', $handler, $_COOKIE['wpsp-session'] ?? null);
		});

		$app->singleton('session.store', fn($app) => $app['session']);
	}

	/*
	 *
	 */

	protected function viewShare(): void {
		$view    = $this->application->make('view');
		$request = $this->application->make('request');
		$view->share([
			'wp_user'         => wp_get_current_user(),
			'current_request' => $request,
		]);
	}

	protected function viewCompose(): void {
		$view = $this->application->make('view');
		$view->composer('*', function(View $view) {
			global $notice;
			$view->with('current_view_name', $view->getName());
			$view->with('notice', $notice);
		});
	}

	/*
	 *
	 */

	protected static function overrideExceptionHandler(): void {
		$existsExceptionHandler = get_exception_handler();

		if ($existsExceptionHandler instanceof \WPSP\App\Instances\Exceptions\Handler) {
			return;
		}

		set_exception_handler(function(\Throwable $e) {
			$handler = new \WPSP\App\Instances\Exceptions\Handler();
			$handler->report($e);
			$handler->render($e);
		});
	}

	/*
	 *
	 */

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