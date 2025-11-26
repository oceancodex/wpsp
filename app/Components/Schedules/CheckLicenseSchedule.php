<?php

namespace WPSP\App\Components\Schedules;

use WPSP\App\Components\License\License;
use WPSPCORE\Components\Schedules\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	public function run() {
		$checkLicense = License::checkLicense(true);
	}

}