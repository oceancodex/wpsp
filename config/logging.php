<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;
use WPSP\Funcs;

return [

	/*
	|--------------------------------------------------------------------------
	| Default Log Channel
	|--------------------------------------------------------------------------
	|
	| This option defines the default log channel that is utilized to write
	| messages to your logs. The value provided here should match one of
	| the channels present in the list of "channels" configured below.
	|
	*/

	'default' => Funcs::env('LOG_CHANNEL', true, 'stack'),

	/*
	|--------------------------------------------------------------------------
	| Deprecations Log Channel
	|--------------------------------------------------------------------------
	|
	| This option controls the log channel that should be used to log warnings
	| regarding deprecated PHP and library features. This allows you to get
	| your application ready for upcoming major versions of dependencies.
	|
	*/

	'deprecations' => [
		'channel' => Funcs::env('LOG_DEPRECATIONS_CHANNEL', true, 'null'),
		'trace' => Funcs::env('LOG_DEPRECATIONS_TRACE', true, false),
	],

	/*
	|--------------------------------------------------------------------------
	| Log Channels
	|--------------------------------------------------------------------------
	|
	| Here you may configure the log channels for your application. Laravel
	| utilizes the Monolog PHP logging library, which includes a variety
	| of powerful log handlers and formatters that you're free to use.
	|
	| Available drivers: "single", "daily", "slack", "syslog",
	|                    "errorlog", "monolog", "custom", "stack"
	|
	*/

	'channels' => [

		'stack' => [
			'driver' => 'stack',
			'channels' => explode(',', (string) Funcs::env('LOG_STACK', true, 'single')),
			'ignore_exceptions' => false,
		],

		'single' => [
			'driver' => 'single',
			'path' => Funcs::instance()->_getStoragePath('logs/laravel.log'),
			'level' => Funcs::env('LOG_LEVEL', true, 'debug'),
			'replace_placeholders' => true,
		],

		'daily' => [
			'driver' => 'daily',
			'path' => Funcs::instance()->_getStoragePath('logs/laravel.log'),
			'level' => Funcs::env('LOG_LEVEL', true, 'debug'),
			'days' => Funcs::env('LOG_DAILY_DAYS', true, 14),
			'replace_placeholders' => true,
		],

		'slack' => [
			'driver' => 'slack',
			'url' => Funcs::env('LOG_SLACK_WEBHOOK_URL', true),
			'username' => Funcs::env('LOG_SLACK_USERNAME', true, 'Laravel Log'),
			'emoji' => Funcs::env('LOG_SLACK_EMOJI', true, ':boom:'),
			'level' => Funcs::env('LOG_LEVEL', true, 'critical'),
			'replace_placeholders' => true,
		],

		'papertrail' => [
			'driver' => 'monolog',
			'level' => Funcs::env('LOG_LEVEL', true, 'debug'),
			'handler' => Funcs::env('LOG_PAPERTRAIL_HANDLER', true, SyslogUdpHandler::class),
			'handler_with' => [
				'host' => Funcs::env('PAPERTRAIL_URL', true),
				'port' => Funcs::env('PAPERTRAIL_PORT', true),
				'connectionString' => 'tls://'.Funcs::env('PAPERTRAIL_URL', true).':'.Funcs::env('PAPERTRAIL_PORT', true),
			],
			'processors' => [PsrLogMessageProcessor::class],
		],

		'stderr' => [
			'driver' => 'monolog',
			'level' => Funcs::env('LOG_LEVEL', true, 'debug'),
			'handler' => StreamHandler::class,
			'handler_with' => [
				'stream' => 'php://stderr',
			],
			'formatter' => Funcs::env('LOG_STDERR_FORMATTER', true),
			'processors' => [PsrLogMessageProcessor::class],
		],

		'syslog' => [
			'driver' => 'syslog',
			'level' => Funcs::env('LOG_LEVEL', true, 'debug'),
			'facility' => Funcs::env('LOG_SYSLOG_FACILITY', true, LOG_USER),
			'replace_placeholders' => true,
		],

		'errorlog' => [
			'driver' => 'errorlog',
			'level' => Funcs::env('LOG_LEVEL', true, 'debug'),
			'replace_placeholders' => true,
		],

		'null' => [
			'driver' => 'monolog',
			'handler' => NullHandler::class,
		],

		'emergency' => [
			'path' => Funcs::instance()->_getStoragePath('logs/laravel.log'),
		],

	],

];