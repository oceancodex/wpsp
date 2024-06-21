<?php

namespace WPSP\app\Components\Schedules;

use WPSPCORE\Base\BaseSchedule;
use WPSP\app\Components\License\License;
use WPSPCORE\Objects\Cache\Cache;

class CheckLicenseSchedule extends BaseSchedule {

	public function init(): void {
		$appShortName  = config('app.short_name');
		$settings      = Cache::getItemValue($appShortName . '_settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null, true);
	}

}