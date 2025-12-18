<?php

namespace WPSP\App\WordPress\Schedules;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Schedules\BaseSchedule;

class test extends BaseSchedule {

	use InstancesTrait;

	public function run() {
		error_log('xxxxxxxxx');
        // Code here...
	}

}