<?php

namespace WPSP\app\Extends\Components\Schedules;

use WPSP\app\Extends\Components\License\License;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	use InstancesTrait;

	public function run(): void {
		$checkLicense = License::checkLicense(true);
	}

}