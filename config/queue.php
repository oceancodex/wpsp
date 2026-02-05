<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | WPSP's queue supports a variety of backends via a single, unified
    | API, giving you convenient access to each backend using identical
    | syntax for each. The default queue connection is defined below.
    |
    */

	'default' => env('WPSP_QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection options for every queue backend
    | used by your application. An example configuration is provided for
    | each backend supported by WPSP. You're also free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis",
    |          "deferred", "background", "failover", "null"
    |
    */

	'connections' => [

		'sync' => [
			'driver' => 'sync',
		],

		'database' => [
			'driver' => 'database',
			'connection' => env('WPSP_DB_QUEUE_CONNECTION', env('WPSP_DB_CONNECTION')),
			'table' => env('WPSP_DB_QUEUE_TABLE', 'jobs'),
			'queue' => env('WPSP_DB_QUEUE', 'default'),
			'retry_after' => (int) env('WPSP_DB_QUEUE_RETRY_AFTER', 90),
			'after_commit' => false,
		],

		'beanstalkd' => [
			'driver' => 'beanstalkd',
			'host' => env('WPSP_BEANSTALKD_QUEUE_HOST', 'localhost'),
			'queue' => env('WPSP_BEANSTALKD_QUEUE', 'default'),
			'retry_after' => (int) env('WPSP_BEANSTALKD_QUEUE_RETRY_AFTER', 90),
			'block_for' => 0,
			'after_commit' => false,
		],

		'sqs' => [
			'driver' => 'sqs',
			'key' => env('WPSP_AWS_ACCESS_KEY_ID'),
			'secret' => env('WPSP_AWS_SECRET_ACCESS_KEY', true),
			'prefix' => env('WPSP_SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
			'queue' => env('WPSP_SQS_QUEUE', 'default'),
			'suffix' => env('WPSP_SQS_SUFFIX'),
			'region' => env('WPSP_AWS_DEFAULT_REGION', 'us-east-1'),
			'after_commit' => false,
		],

		'redis' => [
			'driver' => 'redis',
			'connection' => env('WPSP_REDIS_QUEUE_CONNECTION', 'default'),
			'queue' => env('WPSP_REDIS_QUEUE', 'default'),
			'retry_after' => (int) env('WPSP_REDIS_QUEUE_RETRY_AFTER', 90),
			'block_for' => null,
			'after_commit' => false,
		],

        'deferred' => [
            'driver' => 'deferred',
        ],

        'background' => [
            'driver' => 'background',
        ],

        'failover' => [
            'driver' => 'failover',
            'connections' => [
                'database',
                'deferred',
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
		'database' => env('WPSP_DB_CONNECTION', 'default'),
		'table' => 'job_batches',
	],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control how and where failed jobs are stored. WPSP ships with
    | support for storing failed jobs in a simple file or in a database.
    |
    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
    |
    */

	'failed' => [
		'driver' => env('WPSP_QUEUE_FAILED_DRIVER', 'database-uuids'),
		'database' => env('WPSP_DB_CONNECTION', 'default'),
		'table' => 'failed_jobs',
	],

];