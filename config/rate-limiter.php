<?php
return [

	'default' => [
		'id'       => 'default',
		'policy'   => 'fixed_window',     // 'fixed_window', 'sliding_window' or 'token_bucket'
		'limit'    => 10,
		'interval' => '30 seconds',
	],

	'web' => [
		'id'       => 'web',
		'policy'   => 'fixed_window',
		'limit'    => 10,
		'interval' => '30 seconds',
	],

	'ajax' => [
		'id'       => 'ajax',
		'policy'   => 'fixed_window',
		'limit'    => 10,
		'interval' => '30 seconds',
	],

	'api' => [
		'id'       => 'api',
		'policy'   => 'fixed_window',
		'limit'    => 10,
		'interval' => '30 seconds',
	],

	'sliding_window' => [
		'id'       => 'sliding_window',
		'policy'   => 'sliding_window',
		'limit'    => 10,
		'interval' => '30 seconds',
	],

	'token_bucket' => [
		'id'     => 'token_bucket',
		'policy' => 'token_bucket',
		'limit'  => 10,
		'rate'   => [
			'interval' => '30 seconds',
//			'amount'   => 1
		]
	]

];