<?php
require_once __DIR__ . '/../vendor/autoload.php';
use WPSP\Funcs;

add_action('init', function () {

	/**
	 * Environment.
	 */
	\WPSPCORE\Environment\Environment::init(__DIR__ . '/../');

	/**
	 * Translation.
	 */
	\WPSP\app\Extend\Components\Translation\Translator::init();

	/**
	 * Debug.
	 */
	if (Funcs::config('app.debug')) {
		\Symfony\Component\ErrorHandler\Debug::enable();
	}

	/**
	 * Eloquent.
	 */
//	\WPSPCORE\Objects\Database\Eloquent::init();

	/**
	 * Routers.
	 */
	(new \WPSP\routes\ApiRoute())->init();
	(new \WPSP\routes\WebRoute())->init();
	(new \WPSP\routes\AjaxRoute())->init();
	(new \WPSP\routes\ScheduleRoute())->init();

	/**
	 * Updater.
	 */
	\WPSP\app\Extend\Components\Update\Updater::init();

});