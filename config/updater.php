<?php
use WPSP\Funcs;
return [
	'package_url' => Funcs::instance()->env('UPDATER_PACKAGE_URL', true) ?: ''
];