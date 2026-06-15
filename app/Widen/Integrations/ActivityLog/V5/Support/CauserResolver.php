<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V5\Support;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository;
use WPSP\App\Models\WPUsersModel;
use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\Funcs;

class CauserResolver extends \Spatie\Activitylog\Support\CauserResolver {

	public function __construct() {
		$this->authManager = Auth::instance()->getAuth();
		$this->authDriver  = Funcs::config('activitylog-v5.default_auth_driver');

		// Set causer bằng User WP đã đăng nhập.
//		$this->setCauser(WPUsersModel::find(get_current_user_id()));
	}

}
