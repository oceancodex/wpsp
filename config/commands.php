<?php
return [
	\WPSP\app\Console\Commands\MyCustomCommand::class,

	/**
	 * Route remap commands. Do not remove these commands below.
	 */
	\WPSP\app\Extras\Instances\Commands\RouteRemapCommand::class,
	\WPSP\app\Extras\Instances\Commands\RouteWatchCommand::class,
];