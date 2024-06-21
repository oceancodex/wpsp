<?php

namespace OCBP\app\Components\Schedules;

use OCBPCORE\Base\BaseSchedule;
use OCBP\app\Components\License\License;
use OCBPCORE\Objects\Cache\Cache;

class CheckLicenseSchedule extends BaseSchedule {

	public function init(): void {
		$appShortName  = config('app.short_name');
		$settings      = Cache::getItemValue($appShortName . '_settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null, true);
	}

}