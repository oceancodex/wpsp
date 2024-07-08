<?php

namespace WPSP\app\Extend\Components\Schedules;

use WPSP\app\Extend\Components\License\License;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	use InstancesTrait;

	public function init(): void {
		$checkLicense = License::checkLicense(true);
	}

}