<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\SchedulesRouteTrait;
use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Extend\Components\Schedules\CheckLicenseSchedule;

class Schedules extends BaseRoute {

	use SchedulesRouteTrait, InstancesTrait;

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

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}