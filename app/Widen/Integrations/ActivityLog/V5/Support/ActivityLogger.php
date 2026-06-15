<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Config\Repository;
use Spatie\Activitylog\Support\ActivityLogger as ActivityLoggerCore;
use WPSP\Funcs;

class ActivityLogger extends ActivityLoggerCore {

	public function __construct(Repository $config, ActivityLogStatus $logStatus, CauserResolver $causerResolver) {
		parent::__construct($config, $logStatus, $causerResolver);

		$this->defaultLogName = Funcs::config('activitylog.v5.default_log_name');
	}

}