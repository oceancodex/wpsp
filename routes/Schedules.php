<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\Schedules\Schedules as Route;
use WPSP\App\Widen\Support\Facades\Schedule;
use WPSP\App\WordPress\Schedules\CheckLicenseSchedule;
use WPSP\Funcs;
use WPSPCORE\App\Routes\Schedules\SchedulesRouteTrait;
use WPSP\App\WordPress\Schedules\custom_schedule;

class Schedules {

	use SchedulesRouteTrait;

	/*
	 *
	 */

	public function schedules() {
		// WordPress schedule system.
		Route::schedule('wpsp_check_license', [CheckLicenseSchedule::class, 'run'], ['interval' => 'everyMinute']);

		// WPSP schedule system.
		Schedule::name('WPSP')->call(function() { error_log('WPSP Schedule'); })->everyMinute();
//		Schedule::name('custom_schedule')->call(function() { Funcs::app(custom_schedule::class)->handle(); })->everyMinute();
//		Schedule::name('custom_schedule_run_command')->command('route:remap')->everyMinute();
	}

	/*
	 *
	 */

	public function intervals() {
		Route::interval('everyMinute', 60, 'Every minute');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}