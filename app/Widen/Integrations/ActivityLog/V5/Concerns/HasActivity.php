<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Models\Activity;

trait HasActivity {

	use CausesActivity;
	use LogsActivity;

	/** @return MorphMany<Activity, $this> */
	public function activities(): MorphMany {
		return $this->activitiesAsSubject();
	}

}
