<?php

use WPSP\Funcs;

return [

	/*
	|--------------------------------------------------------------------------
	| Default Mailer
	|--------------------------------------------------------------------------
	|
	| This option controls the default mailer that is used to send all email
	| messages unless another mailer is explicitly specified when sending
	| the message. All additional mailers can be configured within the
	| "mailers" array. Examples of each type of mailer are provided.
	|
	*/

	'default' => Funcs::env('MAIL_MAILER', true, 'log'),

	/*
	|--------------------------------------------------------------------------
	| Mailer Configurations
	|--------------------------------------------------------------------------
	|
	| Here you may configure all of the mailers used by your application plus
	| their respective settings. Several examples have been configured for
	| you and you are free to add your own as your application requires.
	|
	| Application supports a variety of mail "transport" drivers that can be used
	| when delivering an email. You may specify which one you're using for
	| your mailers below. You may also add additional mailers if needed.
	|
	| Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
	|            "postmark", "resend", "log", "array",
	|            "failover", "roundrobin"
	|
	*/

	'mailers' => [

		'smtp' => [
			'transport' => 'smtp',
			'scheme' => Funcs::env('MAIL_SCHEME', true),
			'url' => Funcs::env('MAIL_URL', true),
			'host' => Funcs::env('MAIL_HOST', true, '127.0.0.1'),
			'port' => Funcs::env('MAIL_PORT', true, 2525),
			'username' => Funcs::env('MAIL_USERNAME', true),
			'password' => Funcs::env('MAIL_PASSWORD', true),
			'timeout' => null,
			'local_domain' => Funcs::env('MAIL_EHLO_DOMAIN', true, parse_url((string) Funcs::env('APP_URL', true, 'http://localhost'), PHP_URL_HOST)),
		],

		'ses' => [
			'transport' => 'ses',
		],

		'postmark' => [
			'transport' => 'postmark',
			// 'message_stream_id' => Funcs::env('POSTMARK_MESSAGE_STREAM_ID', true),
			// 'client' => [
			//     'timeout' => 5,
			// ],
		],

		'resend' => [
			'transport' => 'resend',
		],

		'sendmail' => [
			'transport' => 'sendmail',
			'path' => Funcs::env('MAIL_SENDMAIL_PATH', true, '/usr/sbin/sendmail -bs -i'),
		],

		'log' => [
			'transport' => 'log',
			'channel' => Funcs::env('MAIL_LOG_CHANNEL', true),
		],

		'array' => [
			'transport' => 'array',
		],

		'failover' => [
			'transport' => 'failover',
			'mailers' => [
				'smtp',
				'log',
			],
			'retry_after' => 60,
		],

		'roundrobin' => [
			'transport' => 'roundrobin',
			'mailers' => [
				'ses',
				'postmark',
			],
			'retry_after' => 60,
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Global "From" Address
	|--------------------------------------------------------------------------
	|
	| You may wish for all emails sent by your application to be sent from
	| the same address. Here you may specify a name and address that is
	| used globally for all emails that are sent by your application.
	|
	*/

	'from' => [
		'address' => Funcs::env('MAIL_FROM_ADDRESS', true, 'hello@example.com'),
		'name' => Funcs::env('MAIL_FROM_NAME', true, 'Example'),
	],

];