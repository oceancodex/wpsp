<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use WPSP\Funcs;

/**
 * @mixin \Spatie\Activitylog\ActivityLogger
 */
class PendingActivityLog extends \Spatie\Activitylog\PendingActivityLog {

	public function __construct(ActivityLogger $logger, ActivityLogStatus $status) {
		parent::__construct($logger, $status);
		$this->logger = $logger
			->setLogStatus($status)
			->useLog(Funcs::config('activitylog.v4.default_log_name'));
	}

}
