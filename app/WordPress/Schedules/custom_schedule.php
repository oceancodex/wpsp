<?php

namespace WPSP\App\WordPress\Schedules;

use WPSP\App\Services\TestService;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\Schedules\BaseSchedule;

class custom_schedule extends BaseSchedule {

	use InstancesTrait;

//	public $hook     = 'custom_schedule';
//	public $interval = 'everyMinute';

	/*
	 *
	 */

//	public function __wpspConstruct(TestService $testService) {
//		error_log('Schedule "custom-schedule-2" __wpspConstruct!');
//	}

	/*
	 *
	 */

//	public function __invoke(TestService $testService) {
//		$this->handle($testService);
//	}

	/*
	 *
	 */

	public function handle(TestService $testService) {
		// Code here...
		error_log('Schedule "custom_schedule" fired! - Direct call with dependency injection - ' . $testService->test());
	}

}