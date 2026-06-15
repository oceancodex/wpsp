<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use WPSP\Funcs;

class ActivityLogStatus extends \Spatie\Activitylog\ActivityLogStatus {

	public function __construct() {
		$this->enabled = Funcs::config('activitylog.enabled');
	}

}