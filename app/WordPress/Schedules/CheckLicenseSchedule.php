<?php

namespace WPSP\App\WordPress\Schedules;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\WordPress\License\License;
use WPSPCORE\App\WordPress\Schedules\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	use InstancesTrait;

	public function run() {
		$checkLicense = License::checkLicense(true);
	}

}