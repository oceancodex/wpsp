<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use WPSP\App\Models\WPUsersModel;
use WPSP\Funcs;

class ActivityLogger extends \Spatie\Activitylog\Support\ActivityLogger {

	public function __construct(ActivityLogStatus $logStatus, CauserResolver $causerResolver) {
		// Set causer bằng User WP đã đăng nhập.
//		if ($currentUserId = get_current_user_id()) {
//			$causerResolver->setCauser(WPUsersModel::find($currentUserId));
//		}

		$this->causerResolver = $causerResolver;
		$this->defaultLogName = Funcs::config('activitylog-v5.default_log_name');
		$this->logStatus      = $logStatus;
	}

	/*
	 *
	 */

	protected function getActivity(): ActivityContract {
		if (!$this->activity instanceof ActivityContract) {
			$this->activity = Config::activityModelInstance();
			$this
				->useLog($this->defaultLogName)
				->withChanges([])
				->withProperties([])
				->causedBy($this->causerResolver->resolve());
		}

		return $this->activity;
	}

}