<?php

namespace OCBP\routes;

use OCBPCORE\Base\BaseRoute;
use OCBP\app\Components\Schedules\CheckLicenseSchedule;
use OCBPCORE\Traits\ScheduleRouteTrait;

class ScheduleRoute extends BaseRoute {

	use ScheduleRouteTrait;

	public function schedules(): void {
//		$this->schedule('ocbp_check_license', 'hourly', [CheckLicenseSchedule::class, 'init']);
	}

	/*
	 *
	 */

	public function intervals(): void {
//		$this->interval('every_minute', 60, 'Every minute');
	}

}