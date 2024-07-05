<?php

namespace WPSP\routes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Extend\Components\Schedules\CheckLicenseSchedule;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ScheduleRouteTrait;

class ScheduleRoute extends BaseRoute {

	use ScheduleRouteTrait, InstancesTrait;

	/*
	 *
	 */

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