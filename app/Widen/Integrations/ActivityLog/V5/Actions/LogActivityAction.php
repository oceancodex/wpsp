<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Actions;

use WPSP\Funcs;

class LogActivityAction extends \Spatie\Activitylog\Actions\LogActivityAction {

	protected function shouldBuffer(): bool {
		return Funcs::config('activitylog.v5.buffer.enabled', false);
	}

}
