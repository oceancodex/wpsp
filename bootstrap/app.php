<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WPSP\app\Extend\Instances\Translator\Translator;
use WPSP\app\Extend\Instances\Updater\Updater;
use WPSP\Funcs;
use WPSP\routes\AjaxRoute;
use WPSP\routes\ApiRoute;
use WPSP\routes\ScheduleRoute;
use WPSP\routes\WebRoute;
use WPSP\app\Extend\Instances\Database\Eloquent;
use WPSPCORE\Environment\Environment;
use WPSPCORE\ErrorHandler\Debug;

add_action('init', function() {

	/**
	 * Environment.
	 */
	Environment::load(__DIR__ . '/../');

	/**
	 * Debug.
	 */
	if (Funcs::config('app.debug') !== 'false') {
		Debug::enable();
	}

	/**
	 * Translation.
	 */
	(new Translator())->init();

	/**
	 * Eloquent.
	 */
	Eloquent::init();

	/**
	 * Routers.
	 */
	(new ApiRoute())->init();
	(new WebRoute())->init();
	(new AjaxRoute())->init();
	(new ScheduleRoute())->init();

	/**
	 * Updater.
	 */
	(new Updater())->init();

});