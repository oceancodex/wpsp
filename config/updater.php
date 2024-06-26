<?php
use WPSP\Funcs;
return [
	'package_url' => Funcs::env('UPDATER_PACKAGE_URL', true) ?: ''
];