<?php

use WPSP\Funcs;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

	'postmark' => [
		'key' => Funcs::env('POSTMARK_API_KEY', true),
	],

	'resend' => [
		'key' => Funcs::env('RESEND_API_KEY', true),
	],

	'ses' => [
		'key' => Funcs::env('AWS_ACCESS_KEY_ID', true),
		'secret' => Funcs::env('AWS_SECRET_ACCESS_KEY', true),
		'region' => Funcs::env('AWS_DEFAULT_REGION', true, 'us-east-1'),
	],

	'slack' => [
		'notifications' => [
			'bot_user_oauth_token' => Funcs::env('SLACK_BOT_USER_OAUTH_TOKEN', true),
			'channel' => Funcs::env('SLACK_BOT_USER_DEFAULT_CHANNEL', true),
		],
	],

];