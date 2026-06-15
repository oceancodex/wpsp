<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository;
use WPSP\Funcs;

class CauserResolver extends \Spatie\Activitylog\Support\CauserResolver {

	public function __construct(Repository $config, AuthManager $authManager) {
		parent::__construct($config, $authManager);

		$this->authDriver = Funcs::config('activitylog.v5.default_auth_driver');
	}

}
