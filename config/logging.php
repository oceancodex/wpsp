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

	'default' => env('WPSP_LOG_CHANNEL', 'stack'),

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
		'channel' => env('WPSP_LOG_DEPRECATIONS_CHANNEL', 'null'),
		'trace' => env('WPSP_LOG_DEPRECATIONS_TRACE', false),
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

		'queue' => [
			'driver' => 'single',
			'path' => Funcs::instance()->_getStoragePath('logs/queue.log'),
			'level' => 'notice',
		],

		'stack' => [
			'driver' => 'stack',
			'channels' => explode(',', (string) env('WPSP_LOG_STACK', 'single')),
			'ignore_exceptions' => false,
		],

		'single' => [
			'driver' => 'single',
			'path' => Funcs::instance()->_getStoragePath('logs/application.log'),
			'level' => env('WPSP_LOG_LEVEL', 'debug'),
			'replace_placeholders' => true,
		],

		'daily' => [
			'driver' => 'daily',
			'path' => Funcs::instance()->_getStoragePath('logs/application.log'),
			'level' => env('WPSP_LOG_LEVEL', 'debug'),
			'days' => env('WPSP_LOG_DAILY_DAYS', 14),
			'replace_placeholders' => true,
		],

		'slack' => [
			'driver' => 'slack',
			'url' => env('WPSP_LOG_SLACK_WEBHOOK_URL'),
			'username' => env('WPSP_LOG_SLACK_USERNAME', 'Application Log'),
			'emoji' => env('WPSP_LOG_SLACK_EMOJI', ':boom:'),
			'level' => env('WPSP_LOG_LEVEL', 'critical'),
			'replace_placeholders' => true,
		],

		'papertrail' => [
			'driver' => 'monolog',
			'level' => env('WPSP_LOG_LEVEL', 'debug'),
			'handler' => env('WPSP_LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
			'handler_with' => [
				'host' => env('WPSP_PAPERTRAIL_URL'),
				'port' => env('WPSP_PAPERTRAIL_PORT'),
				'connectionString' => 'tls://'.env('WPSP_PAPERTRAIL_URL').':'.env('WPSP_PAPERTRAIL_PORT'),
			],
			'processors' => [PsrLogMessageProcessor::class],
		],

		'stderr' => [
			'driver' => 'monolog',
			'level' => env('WPSP_LOG_LEVEL', 'debug'),
			'handler' => StreamHandler::class,
			'handler_with' => [
				'stream' => 'php://stderr',
			],
			'formatter' => env('WPSP_LOG_STDERR_FORMATTER'),
			'processors' => [PsrLogMessageProcessor::class],
		],

		'syslog' => [
			'driver' => 'syslog',
			'level' => env('WPSP_LOG_LEVEL', 'debug'),
			'facility' => env('WPSP_LOG_SYSLOG_FACILITY', LOG_USER),
			'replace_placeholders' => true,
		],

		'errorlog' => [
			'driver' => 'errorlog',
			'level' => env('WPSP_LOG_LEVEL', 'debug'),
			'replace_placeholders' => true,
		],

		'null' => [
			'driver' => 'monolog',
			'handler' => NullHandler::class,
		],

		'emergency' => [
			'path' => Funcs::instance()->_getStoragePath('logs/application.log'),
		],

	],

];