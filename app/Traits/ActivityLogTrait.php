<?php

namespace WPSP\App\Traits;

use WPSP\App\Models\WPUsersModel;
use Spatie\Activitylog\Contracts\Activity;

trait ActivityLogTrait {

	public function beforeActivityLogged(Activity $activity, string $eventName): void {
		$activity->setAttribute('causer_type', WPUsersModel::class);
		$activity->setAttribute('causer_id', get_current_user_id());
	}

	public function activities() {
		return $this->morphMany(
			\Spatie\Activitylog\Models\Activity::class,
			'subject'
		);
	}

}
