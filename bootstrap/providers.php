<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Core Framework
	|--------------------------------------------------------------------------
	*/
	Illuminate\Events\EventServiceProvider::class,
	Illuminate\Filesystem\FilesystemServiceProvider::class,
	Illuminate\Cache\CacheServiceProvider::class,
	Illuminate\Encryption\EncryptionServiceProvider::class,
	Illuminate\Hashing\HashServiceProvider::class,
	Illuminate\Log\LogServiceProvider::class,
	Illuminate\Pipeline\PipelineServiceProvider::class,

	/*
	|--------------------------------------------------------------------------
	| Database, Queue, Redis
	|--------------------------------------------------------------------------
	*/
	Illuminate\Database\DatabaseServiceProvider::class,
	Illuminate\Queue\QueueServiceProvider::class,
	Illuminate\Redis\RedisServiceProvider::class,

	/*
	|--------------------------------------------------------------------------
	| HTTP, Session, Auth, View
	|--------------------------------------------------------------------------
	*/
	Illuminate\Cookie\CookieServiceProvider::class,
	Illuminate\Session\SessionServiceProvider::class,
	Illuminate\Auth\AuthServiceProvider::class,
	Spatie\Permission\PermissionServiceProvider::class,
	Illuminate\View\ViewServiceProvider::class,

	/*
	|--------------------------------------------------------------------------
	| Mail, Validation, Translation, Routing
	|--------------------------------------------------------------------------
	*/
	Illuminate\Mail\MailServiceProvider::class,
	Illuminate\Validation\ValidationServiceProvider::class,
	Illuminate\Translation\TranslationServiceProvider::class,

	/*
	|--------------------------------------------------------------------------
	| Console & Foundation (core commands, etc.)
	|--------------------------------------------------------------------------
	*/
	Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
	Illuminate\Foundation\Providers\FoundationServiceProvider::class,

	/*
	|--------------------------------------------------------------------------
	| Application Providers
	|--------------------------------------------------------------------------
	*/
	WPSP\App\Providers\AppServiceProvider::class,
	WPSP\App\Providers\ConsoleServiceProvider::class,
	WPSP\App\Providers\WPUsersServiceProvider::class,
];
