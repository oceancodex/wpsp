<?php

namespace WPSP\app\Extend\Components\Schedules;

use Cache\Cache;
use WPSP\app\Extend\Components\License\License;
use WPSPCORE\Base\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	public function init(): void {
		$appShortName  = config('app.short_name');
		$settings      = Cache::getItemValue($appShortName . '_settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null, true);
	}

}