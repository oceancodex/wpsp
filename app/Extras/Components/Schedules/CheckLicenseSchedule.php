<?php

namespace WPSP\app\Extras\Components\Schedules;

use WPSP\app\Extras\Components\License\License;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	use InstancesTrait;

	public function run(): void {
		$checkLicense = License::checkLicense(true);
	}

}