<?php

namespace WPSP\App\WordPress\Schedules;

use WPSP\App\Services\TestService;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\WordPress\License\License;
use WPSPCORE\App\WordPress\Schedules\BaseSchedule;

class CheckLicenseSchedule extends BaseSchedule {

	use InstancesTrait;

//	public $hook     = 'custom_schedule';
//	public $interval = 'hourly';

	public function handle(TestService $testService) {
//		error_log('Run schedule: CheckLicenseSchedule');
		error_log('Run schedule: CheckLicenseSchedule => ' . $testService->test() . ' => ' . $testService->subTestService->subTest());
//		$checkLicense = License::checkLicense(true);
	}

}