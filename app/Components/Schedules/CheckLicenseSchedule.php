<?php

namespace WPSP\App\Components\Schedules;

use WPSP\App\Components\License\License;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	public function run() {
		$checkLicense = License::checkLicense(true);
	}

}