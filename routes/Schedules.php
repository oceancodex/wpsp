<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\Schedules\Schedules as Route;
use WPSP\App\Widen\Support\Facades\Schedule;
use WPSP\App\WordPress\Schedules\CheckLicenseSchedule;
use WPSPCORE\App\Routes\Schedules\SchedulesRouteTrait;

class Schedules {

	use SchedulesRouteTrait;

	/*
	 *
	 */

	public function schedules() {
		// WordPress schedule system.
		Route::schedule('wpsp_check_license', [CheckLicenseSchedule::class, 'run'], ['interval' => 'every_minute']);

		// WPSP schedule system.
		Schedule::name('WPSP')->call(function() { error_log('WPSP Schedule'); })->everyMinute();
	}

	/*
	 *
	 */

	public function intervals() {
		Route::interval('every_minute', 60, 'Every minute');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}