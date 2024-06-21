<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WPSPCORE\Objects\Translation\Translator;

/**
 * Translation.
 */
Translator::init();

/**
 * Debug.
 */
if (config('app.debug')) {
	\Symfony\Component\ErrorHandler\Debug::enable();
}

/**
 * Eloquent.
 */
\WPSPCORE\Objects\Database\Eloquent::init();

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
\WPSPCORE\Objects\Updater\Updater::init();