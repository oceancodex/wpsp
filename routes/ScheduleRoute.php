<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSP\app\Components\Schedules\CheckLicenseSchedule;
use WPSPCORE\Traits\ScheduleRouteTrait;

class ScheduleRoute extends BaseRoute {

	use ScheduleRouteTrait;

	public function schedules(): void {
//		$this->schedule('wpsp_check_license', 'hourly', [CheckLicenseSchedule::class, 'init']);
	}

	/*
	 *
	 */

	public function intervals(): void {
//		$this->interval('every_minute', 60, 'Every minute');
	}

}