<?php

namespace WPSP\App\Widen\Integrations\ActivityLog;

use Illuminate\Support\Traits\ForwardsCalls;
use Spatie\Activitylog\ActivityLogStatus;
use WPSP\Funcs;

/**
 * @mixin \Spatie\Activitylog\ActivityLogger
 */
class PendingActivityLog extends \Spatie\Activitylog\PendingActivityLog {

	use ForwardsCalls;

	public function __construct(ActivityLogger $logger, ActivityLogStatus $status) {
		$this->logger = $logger
			->setLogStatus($status)
			->useLog(Funcs::config('activitylog.default_log_name'));
	}

}
