<?php

namespace WPSP\App\WP\Schedules;

use WPSP\App\WP\License\License;
use WPSPCORE\app\WP\Schedules\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	public function run() {
		$checkLicense = License::checkLicense(true);
	}

}