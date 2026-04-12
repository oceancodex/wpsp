<?php

namespace WPSP\App\WordPress\Schedules;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\Schedules\BaseSchedule;

class custom_schedule extends BaseSchedule {

	use InstancesTrait;

//	public $hook     = 'custom_schedule';
//	public $interval = 'hourly';

	public function handle() {
		error_log('Custom schedule fired!');
	}

}