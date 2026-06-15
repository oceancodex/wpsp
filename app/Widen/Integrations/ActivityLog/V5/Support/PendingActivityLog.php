<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Support\Traits\ForwardsCalls;
use WPSP\Funcs;

/**
 * @mixin \Spatie\Activitylog\ActivityLogger
 */
class PendingActivityLog extends \Spatie\Activitylog\Support\PendingActivityLog {

	use ForwardsCalls;

	public function __construct(ActivityLogger $logger, ActivityLogStatus $status) {
		$this->logger = $logger
			->setLogStatus($status)
			->useLog(Funcs::config('activitylog.v5.default_log_name'));
	}

}
