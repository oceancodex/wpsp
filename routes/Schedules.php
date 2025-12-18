<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\Schedules\Schedules as Route;
use WPSP\App\WordPress\Schedules\CheckLicenseSchedule;
use WPSPCORE\App\Routes\Schedules\SchedulesRouteTrait;
use WPSP\App\WordPress\Schedules\test;

class Schedules {

	use SchedulesRouteTrait;

	/*
	 *
	 */

	public function schedules() {
        Route::schedule('test', [test::class, 'run'], ['interval' => 'every_minute']);
		Route::schedule('wpsp_check_license', [CheckLicenseSchedule::class, 'run'], ['interval' => 'every_minute']);
	}

	/*
	 *
	 */

	public function intervals() {
		$this->interval('every_minute', 60, 'Every minute');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}