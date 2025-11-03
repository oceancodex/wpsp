<?php

namespace WPSP\app\Components\Schedules;

use WPSP\app\Components\License\License;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	public function run() {
		$checkLicense = License::checkLicense(true);
	}

}