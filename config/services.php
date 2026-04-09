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
		'key' => env('WPSP_POSTMARK_API_KEY'),
	],

	'resend' => [
		'key' => env('WPSP_RESEND_API_KEY'),
	],

	'ses' => [
		'key' => env('WPSP_AWS_ACCESS_KEY_ID'),
		'secret' => env('WPSP_AWS_SECRET_ACCESS_KEY'),
		'region' => env('WPSP_AWS_DEFAULT_REGION', 'us-east-1'),
	],

	'slack' => [
		'notifications' => [
			'bot_user_oauth_token' => env('WPSP_SLACK_BOT_USER_OAUTH_TOKEN'),
			'channel' => env('WPSP_SLACK_BOT_USER_DEFAULT_CHANNEL'),
		],
	],

];