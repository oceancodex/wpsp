<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Contracts\Config\Repository;
use WPSP\Funcs;

class ActivityLogStatus extends \Spatie\Activitylog\Support\ActivityLogStatus {

	public function __construct() {
		$this->enabled = Funcs::config('activitylog-v5.enabled') ?? true;
	}

}