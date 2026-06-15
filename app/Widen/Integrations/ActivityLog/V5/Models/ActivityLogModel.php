<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use WPSP\App\Widen\Traits\ModelsTrait;
use WPSP\Funcs;

class ActivityLogModel extends \Spatie\Activitylog\Models\Activity {

	use ModelsTrait;

//	protected $connection = 'wp_kdntest';
	protected $table      = 'activity_log';

	/*
	 *
	 */

	public function subject(): MorphTo {
		if (Funcs::config('activitylog.v5.include_soft_deleted_subjects')) {
			return $this->morphTo()->withoutGlobalScope(SoftDeletingScope::class);
		}

		return $this->morphTo();
	}

}