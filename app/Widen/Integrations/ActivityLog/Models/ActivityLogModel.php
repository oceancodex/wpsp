<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\Models;

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
		if (Funcs::config('activitylog.subject_returns_soft_deleted_models')) {
			return $this->morphTo()->withoutGlobalScope(SoftDeletingScope::class);
		}

		return $this->morphTo();
	}

}