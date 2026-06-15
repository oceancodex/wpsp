<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Contracts\Config\Repository;

class ActivityLogStatus extends \Spatie\Activitylog\Support\ActivityLogStatus {

	protected bool $enabled = true;

	public function __construct(Repository $config) {
		$this->enabled = $config['activitylog.enabled'] ?? true;
	}

}
