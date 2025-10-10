<?php

namespace WPSP\app\Extras\Components\Schedules;

use WPSP\app\Extras\Components\License\License;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	public function run(): void {
		$checkLicense = License::checkLicense(true);
	}

}