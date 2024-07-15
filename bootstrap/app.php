<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Extend\Instances\Cache\RateLimiter;
use WPSP\app\Extend\Instances\Database\Eloquent;
use WPSP\app\Extend\Instances\Database\Migration;
use WPSP\app\Extend\Instances\Translator\Translator;
use WPSP\app\Extend\Instances\Updater\Updater;
use WPSP\Funcs;
use WPSP\routes\AjaxRoute;
use WPSP\routes\ApiRoute;
use WPSP\routes\ScheduleRoute;
use WPSP\routes\WebRoute;
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
	 * Migration.
	 */
	Migration::init();

	/**
	 * Eloquent.
	 */
	Eloquent::init();

	/**
	 * Cache.
	 */
	Cache::init();

	/**
     * Rate Limiter.
     */
	RateLimiter::init();

	/**
	 * Translation.
	 */
	(new Translator())->init();

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