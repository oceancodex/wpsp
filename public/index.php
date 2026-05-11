<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

define('WPSP_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__.'/../routes/original/web.php',
		commands: __DIR__.'/../routes/original/console.php',
		health: '/up',
	)
	->withMiddleware(function (Middleware $middleware): void {
		//
	})
	->withExceptions(function (Exceptions $exceptions): void {
		//
	})->create();

$app->handleRequest(Request::capture());
