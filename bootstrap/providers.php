<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Core Laravel Providers (Full Stack)
	|--------------------------------------------------------------------------
	*/
//	Illuminate\Auth\AuthServiceProvider::class,
	WPSPCORE\Auth\AuthServiceProvider::class,
	Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
	Illuminate\Broadcasting\BroadcastServiceProvider::class,
	Illuminate\Bus\BusServiceProvider::class,
	Illuminate\Cache\CacheServiceProvider::class,
	Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
	Illuminate\Cookie\CookieServiceProvider::class,
	Illuminate\Database\DatabaseServiceProvider::class,
	Illuminate\Encryption\EncryptionServiceProvider::class,
	Illuminate\Filesystem\FilesystemServiceProvider::class,
	Illuminate\Foundation\Providers\FoundationServiceProvider::class,
	Illuminate\Hashing\HashServiceProvider::class,
	Illuminate\Mail\MailServiceProvider::class,
	Illuminate\Notifications\NotificationServiceProvider::class,
	Illuminate\Pagination\PaginationServiceProvider::class,
	Illuminate\Pipeline\PipelineServiceProvider::class,
	Illuminate\Queue\QueueServiceProvider::class,
	Illuminate\Redis\RedisServiceProvider::class,
	Illuminate\Session\SessionServiceProvider::class,
	Illuminate\Translation\TranslationServiceProvider::class,
	Illuminate\Validation\ValidationServiceProvider::class,
	Illuminate\View\ViewServiceProvider::class,

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
	WPSP\App\Providers\WPUsersServiceProvider::class,
];
