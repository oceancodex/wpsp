<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use Spatie\Activitylog\ActivityLogger as ActivityLoggerCore;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class ActivityLogger extends ActivityLoggerCore {

	protected function getActivity(): ActivityContract {
		if (!$this->activity instanceof ActivityContract) {
			$this->activity = ActivitylogServiceProvider::getActivityModelInstance();
			$this
				->useLog($this->defaultLogName)
				->withProperties([])
				->causedBy($this->causerResolver->resolve());

			$this->activity->batch_uuid = $this->batch->getUuid();
		}

		return $this->activity;
	}

}