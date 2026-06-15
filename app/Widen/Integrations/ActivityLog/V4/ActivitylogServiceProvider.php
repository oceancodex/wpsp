<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Spatie\Activitylog\Exceptions\InvalidConfiguration;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use WPSP\Funcs;

class ActivitylogServiceProvider extends \Spatie\Activitylog\ActivitylogServiceProvider {

	public static function determineActivityModel(): string {
		$activityModel = Funcs::config('activitylog.v4.activity_model') ?? ActivityModel::class;

		if (!is_a($activityModel, Activity::class, true)
			|| !is_a($activityModel, Model::class, true)) {
			throw InvalidConfiguration::modelIsNotValid($activityModel);
		}

		return $activityModel;
	}

	public static function getActivityModelInstance(): ActivityContract {
		$activityModelClassName = static::determineActivityModel();

		return new $activityModelClassName();
	}

}