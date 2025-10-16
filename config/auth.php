<?php

use WPSP\Funcs;

return [

	/*
	|--------------------------------------------------------------------------
	| Authentication Defaults
	|--------------------------------------------------------------------------
	|
	| This option defines the default authentication "guard" and password
	| reset "broker" for your application. You may change these values
	| as required, but they're a perfect start for most applications.
	|
	*/

	'defaults' => [
		'guard' => Funcs::env('AUTH_GUARD', true, 'web'),
		'passwords' => Funcs::env('AUTH_PASSWORD_BROKER', true, 'users'),
	],

	/*
	|--------------------------------------------------------------------------
	| Authentication Guards
	|--------------------------------------------------------------------------
	|
	| Next, you may define every authentication guard for your application.
	| Of course, a great default configuration has been defined for you
	| which utilizes session storage plus the Eloquent user provider.
	|
	| All authentication guards have a user provider, which defines how the
	| users are actually retrieved out of your database or other storage
	| system used by the application. Typically, Eloquent is utilized.
	|
	| Supported: "session", "token", "sanctum"
	|
	*/

	'guards' => [
		'web' => [
			'driver' => 'session',
			'provider' => 'db_cm_users',
		],
		'sanctum' => [
			'driver' => 'sanctum',
			'provider' => 'db_cm_users',
		],
//		'wp' => [
//			'driver' => 'session',
//			'provider' => 'wp_users',
//		],
		'api' => [
			'driver' => 'token',
			'provider' => 'db_cm_users',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| User Providers
	|--------------------------------------------------------------------------
	|
	| All authentication guards have a user provider, which defines how the
	| users are actually retrieved out of your database or other storage
	| system used by the application. Typically, Eloquent is utilized.
	|
	| If you have multiple user tables or models you may configure multiple
	| providers to represent the model / table. These providers may then
	| be assigned to any extra authentication guards you have defined.
	|
	| Supported: "database", "eloquent"
	|
	*/

	'providers' => [
		'users' => [
			'driver' => 'eloquent',
			'model'  => \WPSP\app\Models\UsersModel::class,
			'auth_service' => \WPSP\app\Providers\UsersServiceProvider::class,
		],
		'db_cm_users' => [
			'driver' => 'database',
			'table'  => 'wp_wpsp_cm_users',
//			'model'  => \WPSP\app\Models\UsersModel::class,
			'auth_service' => \WPSP\app\Providers\UsersServiceProvider::class,
		],
		'wp_users' => [
			'driver' => 'eloquent',
			'model'  => \WPSP\app\Models\WPUsersModel::class,
			'auth_service' => \WPSP\app\Providers\WPUsersServiceProvider::class,
		],
		'db_wp_users' => [
			'driver' => 'database',
			'table'  => 'wp_users',
			'auth_service' => \WPSP\app\Providers\WPUsersServiceProvider::class,
		],
//		'apis' => [
//			'driver' => 'eloquent',
//			'model'  => \WPSP\app\Models\UsersModel::class,
//			'auth_service' => \WPSP\app\Providers\UsersServiceProvider::class
//		],
	],

	/*
	|--------------------------------------------------------------------------
	| Resetting Passwords
	|--------------------------------------------------------------------------
	|
	| These configuration options specify the behavior of Laravel's password
	| reset functionality, including the table utilized for token storage
	| and the user provider that is invoked to actually retrieve users.
	|
	| The expiry time is the number of minutes that each reset token will be
	| considered valid. This security feature keeps tokens short-lived so
	| they have less time to be guessed. You may change this as needed.
	|
	| The throttle setting is the number of seconds a user must wait before
	| generating more password reset tokens. This prevents the user from
	| quickly generating a very large amount of password reset tokens.
	|
	*/

	'passwords' => [
		'users' => [
			'driver' => 'cache',
			'provider' => 'users',
			'table' => Funcs::env('AUTH_PASSWORD_RESET_TOKEN_TABLE', true, 'password_reset_tokens'),
			'expire' => 60,
			'throttle' => 60,
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Password Confirmation Timeout
	|--------------------------------------------------------------------------
	|
	| Here you may define the number of seconds before a password confirmation
	| window expires and users are asked to re-enter their password via the
	| confirmation screen. By default, the timeout lasts for three hours.
	|
	*/

	'password_timeout' => Funcs::env('AUTH_PASSWORD_TIMEOUT', true, 10800),

];