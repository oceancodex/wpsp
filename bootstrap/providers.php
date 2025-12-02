<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Third-party
	|--------------------------------------------------------------------------
	*/
	Spatie\Permission\PermissionServiceProvider::class,

	/*
	|--------------------------------------------------------------------------
	| App-specific
	|--------------------------------------------------------------------------
	*/
	WPSP\App\Providers\AppServiceProvider::class,
	WPSP\App\Providers\EventServiceProvider::class,
	WPSP\App\Providers\ConsoleServiceProvider::class,
];
