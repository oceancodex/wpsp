<?php

use WPSP\Funcs;

return [

	/*
	|--------------------------------------------------------------------------
	| Default Queue Connection Name
	|--------------------------------------------------------------------------
	|
	| Laravel's queue supports a variety of backends via a single, unified
	| API, giving you convenient access to each backend using identical
	| syntax for each. The default queue connection is defined below.
	|
	*/

	'default' => Funcs::env('QUEUE_CONNECTION', true, 'database'),

	/*
	|--------------------------------------------------------------------------
	| Queue Connections
	|--------------------------------------------------------------------------
	|
	| Here you may configure the connection options for every queue backend
	| used by your application. An example configuration is provided for
	| each backend supported by Laravel. You're also free to add more.
	|
	| Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "failover", "null"
	|
	*/

	'connections' => [

		'sync' => [
			'driver' => 'sync',
		],

		'database' => [
			'driver' => 'database',
			'connection' => Funcs::env('DB_QUEUE_CONNECTION', true),
			'table' => Funcs::env('DB_QUEUE_TABLE', true, 'jobs'),
			'queue' => Funcs::env('DB_QUEUE', true, 'default'),
			'retry_after' => (int) Funcs::env('DB_QUEUE_RETRY_AFTER', true, 90),
			'after_commit' => false,
		],

		'beanstalkd' => [
			'driver' => 'beanstalkd',
			'host' => Funcs::env('BEANSTALKD_QUEUE_HOST', true, 'localhost'),
			'queue' => Funcs::env('BEANSTALKD_QUEUE', true, 'default'),
			'retry_after' => (int) Funcs::env('BEANSTALKD_QUEUE_RETRY_AFTER', true, 90),
			'block_for' => 0,
			'after_commit' => false,
		],

		'sqs' => [
			'driver' => 'sqs',
			'key' => Funcs::env('AWS_ACCESS_KEY_ID', true),
			'secret' => Funcs::env('AWS_SECRET_ACCESS_KEY', true),
			'prefix' => Funcs::env('SQS_PREFIX', true, 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
			'queue' => Funcs::env('SQS_QUEUE', true, 'default'),
			'suffix' => Funcs::env('SQS_SUFFIX', true),
			'region' => Funcs::env('AWS_DEFAULT_REGION', true, 'us-east-1'),
			'after_commit' => false,
		],

		'redis' => [
			'driver' => 'redis',
			'connection' => Funcs::env('REDIS_QUEUE_CONNECTION', true, 'default'),
			'queue' => Funcs::env('REDIS_QUEUE', true, 'default'),
			'retry_after' => (int) Funcs::env('REDIS_QUEUE_RETRY_AFTER', true, 90),
			'block_for' => null,
			'after_commit' => false,
		],

		'failover' => [
			'driver' => 'failover',
			'connections' => [
				'database',
				'sync',
			],
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Job Batching
	|--------------------------------------------------------------------------
	|
	| The following options configure the database and table that store job
	| batching information. These options can be updated to any database
	| connection and table which has been defined by your application.
	|
	*/

	'batching' => [
		'database' => Funcs::env('DB_CONNECTION', true, 'sqlite'),
		'table' => 'job_batches',
	],

	/*
	|--------------------------------------------------------------------------
	| Failed Queue Jobs
	|--------------------------------------------------------------------------
	|
	| These options configure the behavior of failed queue job logging so you
	| can control how and where failed jobs are stored. Laravel ships with
	| support for storing failed jobs in a simple file or in a database.
	|
	| Supported drivers: "database-uuids", "dynamodb", "file", "null"
	|
	*/

	'failed' => [
		'driver' => Funcs::env('QUEUE_FAILED_DRIVER', true, 'database-uuids'),
		'database' => Funcs::env('DB_CONNECTION', true, 'sqlite'),
		'table' => 'failed_jobs',
	],

];