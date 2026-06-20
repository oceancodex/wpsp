<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use WPSP\WPSP;

if (defined('WPSP_ORIGINAL_WP') && WPSP_ORIGINAL_WP) {
	$wpsp = WPSP::start(false);
	$app  = $wpsp->getApplication();
	return $app;
}
else {
	return Application::configure(basePath: dirname(__DIR__))
		->withRouting(
			web     : __DIR__ . '/../routes/original/web.php',
			api     : __DIR__ . '/../routes/original/api.php',
			commands: __DIR__ . '/../routes/original/console.php',
			health  : '/up',
//			apiPrefix: 'api/admin',
		)
		->withMiddleware(function(Middleware $middleware): void {
			//
		})
		->withExceptions(function(Exceptions $exceptions): void {
			$exceptions->shouldRenderJsonWhen(
				fn (\Illuminate\Http\Request $request) => $request->is('api/*') || $request->expectsJson(),
			);
		})->create();
}