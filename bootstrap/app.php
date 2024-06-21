<?php
require_once __DIR__ . '/../vendor/autoload.php';

use OCBPCORE\Objects\Translation\Translator;

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
\OCBPCORE\Objects\Database\Eloquent::init();

/**
 * Routers.
 */
(new \OCBP\routes\ApiRoute())->init();
(new \OCBP\routes\WebRoute())->init();
(new \OCBP\routes\AjaxRoute())->init();
(new \OCBP\routes\ScheduleRoute())->init();

/**
 * Updater.
 */
\OCBPCORE\Objects\Updater\Updater::init();