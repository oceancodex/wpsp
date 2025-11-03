<?php

namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\SchedulesRouteTrait;
use WPSP\Funcs;
use WPSP\app\Components\Schedules\CheckLicenseSchedule;

class Schedules extends BaseRoute {

	use InstancesTrait, SchedulesRouteTrait;

	/*
	 *
	 */

	public function schedules() {
		$this->schedule('wpsp_check_license', 'every_minute', [CheckLicenseSchedule::class, 'run']);
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