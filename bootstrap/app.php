<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Foundation\Bootstrap\RegisterProviders;

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

$app = Application::configure(basePath: dirname(__DIR__))
	->withMiddleware(function(Middleware $middleware): void {})
	->withExceptions(function(Exceptions $exceptions): void {})
	->withProviders()
	->create();

(new LoadEnvironmentVariables)->bootstrap($app);

$prefix = 'WPSP_';
foreach ($_ENV as $key => $value) {
	if (str_starts_with($key, $prefix)) {
		$plainKey = substr($key, strlen($prefix));
		if (!isset($_ENV[$plainKey])) $_ENV[$plainKey] = $value;
		if (!isset($_SERVER[$plainKey])) $_SERVER[$plainKey] = $value;
		if (getenv($plainKey) === false) putenv("$plainKey=$value");
	}
}

(new LoadConfiguration)->bootstrap($app);
(new RegisterFacades)->bootstrap($app);
(new RegisterProviders)->bootstrap($app);

$app->singleton('files', fn() => new Filesystem());

$app->boot();

return $app;