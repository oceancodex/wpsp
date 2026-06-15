<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Spatie\Activitylog\Exceptions\InvalidConfiguration;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use WPSP\Funcs;

class Config extends \Spatie\Activitylog\Support\Config {

	public static function activityModel(): string {
		$activityModel = Funcs::config('activitylog-v5.activity_model') ?? ActivityModel::class;

		if (!is_a($activityModel, ActivityContract::class, true)) {
			throw InvalidConfiguration::modelIsNotValid($activityModel);
		}

		if (!is_a($activityModel, Model::class, true)) {
			throw InvalidConfiguration::modelIsNotValid($activityModel);
		}

		return $activityModel;
	}

	protected static function resolveAction(string $configKey, string $defaultClass): mixed {
		$actionClass = Funcs::config($configKey) ?? $defaultClass;

		if (!is_a($actionClass, $defaultClass, true)) {
			throw InvalidConfiguration::actionIsNotValid($actionClass, $defaultClass);
		}

		return Funcs::app($actionClass);
	}

}
