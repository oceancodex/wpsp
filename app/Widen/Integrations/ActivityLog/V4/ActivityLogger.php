<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Spatie\Activitylog\LogBatch;
use WPSP\App\Models\WPUsersModel;
use WPSP\Funcs;

class ActivityLogger extends \Spatie\Activitylog\ActivityLogger {

	public function __construct(ActivityLogStatus $logStatus, LogBatch $batch, CauserResolver $causerResolver) {
		// Set causer bằng User WP đã đăng nhập.
//		if ($currentUserId = get_current_user_id()) {
//			$causerResolver->setCauser(WPUsersModel::find($currentUserId));
//		}

		$this->causerResolver = $causerResolver;
		$this->batch          = $batch;
		$this->defaultLogName = Funcs::config('activitylog.default_log_name');
		$this->logStatus      = $logStatus;
	}

	/*
	 *
	 */

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