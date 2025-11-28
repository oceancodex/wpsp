<?php

namespace WPSP\routes;

use WPSP\App\WP\Schedules\CheckLicenseSchedule;
use WPSP\App\Instances\Routes\Schedules as Route;
use WPSPCORE\Routes\Schedules\SchedulesRouteTrait;

class Schedules {

	use SchedulesRouteTrait;

	/*
	 *
	 */

	public function schedules() {
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