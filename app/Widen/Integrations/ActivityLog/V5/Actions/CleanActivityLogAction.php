<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Actions;

use Illuminate\Database\Eloquent\Builder;
use WPSP\App\Widen\Integrations\ActivityLog\V5\Support\Config;

class CleanActivityLogAction extends \Spatie\Activitylog\Actions\CleanActivityLogAction {

	protected function deleteOldActivities(string $cutOffDate, ?string $logName): int {
		$activity = Config::activityModelInstance();

		return $activity::query()
			->where('created_at', '<', $cutOffDate)
			->when($logName !== null, function(Builder $query) use ($logName) {
				$query->inLog($logName);
			})
			->delete();
	}

}
