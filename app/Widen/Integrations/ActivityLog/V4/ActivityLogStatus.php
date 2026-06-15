<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use Illuminate\Contracts\Config\Repository;
use WPSP\Funcs;

class ActivityLogStatus extends \Spatie\Activitylog\ActivityLogStatus {

	public function __construct(Repository $config) {
		$this->enabled = Funcs::config('activitylog.v4.enabled') ?? true;
	}

}