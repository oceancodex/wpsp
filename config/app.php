<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

	'name' => env('WPSP_APP_NAME', 'WordPress Starter Plugin'),

	/*
	|--------------------------------------------------------------------------
	| Application Short Name
	|--------------------------------------------------------------------------
	*/

	'short_name' => env('WPSP_APP_SHORT_NAME', 'wpsp'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

	'env' => env('WPSP_APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

	'debug' => (bool) env('WPSP_APP_DEBUG', false),

	/*
	|--------------------------------------------------------------------------
	| Application Debug Type
	|--------------------------------------------------------------------------
	*/

	'debug_type' => env('WPSP_APP_DEBUG_TYPE', 'simple'),

	/*
	|--------------------------------------------------------------------------
	| Application Live Reload Mode
	|--------------------------------------------------------------------------
	*/

	'live_reload' => env('WPSP_APP_LIVE_RELOAD', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

	'url' => env('WPSP_APP_URL', 'https://localhost'),

	/*
	|--------------------------------------------------------------------------
	| Application Assets URL
	|--------------------------------------------------------------------------
	*/

	'asset_url' => env('WPSP_ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by WPSP's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

	'locale' => \WPSP\Funcs::locale() ?? env('WPSP_APP_LOCALE', 'en'),

	'fallback_locale' => env('WPSP_APP_FALLBACK_LOCALE', 'en'),

	'faker_locale' => env('WPSP_APP_FAKER_LOCALE', 'en_US'),

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'cipher' => 'AES-256-CBC',

	'key' => env('WPSP_APP_KEY'),

	'previous_keys' => [
		...array_filter(
			explode(',', env('WPSP_APP_PREVIOUS_KEYS', ''))
		),
	],

	/*
	|--------------------------------------------------------------------------
	| Maintenance Mode Driver
	|--------------------------------------------------------------------------
	|
	| These configuration options determine the driver used to determine and
	| manage "maintenance mode" status. The "cache" driver will
	| allow maintenance mode to be controlled across multiple machines.
	|
	| Supported drivers: "file", "cache"
	|
	*/

	'maintenance' => [
		'driver' => env('WPSP_APP_MAINTENANCE_DRIVER', 'file'),
		'store' => env('WPSP_APP_MAINTENANCE_STORE', 'database'),
	],

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => [

		/*
		 * Framework Service Providers...
		 */

		/*
		 * Package Service Providers...
		 */

		/*
		 * Application Service Providers...
		 */

	],

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => [
		// 'ExampleClass' => App\Example\ExampleClass::class,
	],

];
