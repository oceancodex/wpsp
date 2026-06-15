<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Models\Activity;
use WPSP\App\Widen\Integrations\ActivityLog\V5\Support\Config;

trait CausesActivity {

	/** @return MorphMany<Activity, $this> */
	public function activitiesAsCauser(): MorphMany {
		return $this->morphMany(
			Config::activityModel(),
			'causer'
		);
	}

}
