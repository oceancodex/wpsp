<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use WPSP\Funcs;

class PendingActivityLog extends \Spatie\Activitylog\PendingActivityLog {

	public function __construct(ActivityLogger $logger, ActivityLogStatus $status) {
		$this->logger = $logger
			->setLogStatus($status)
			->useLog(Funcs::config('activitylog.default_log_name'));
	}

}
