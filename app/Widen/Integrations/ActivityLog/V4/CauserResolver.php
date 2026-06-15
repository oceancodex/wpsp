<?php

namespace WPSP\App\Widen\Integrations\ActivityLog\V4;

use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\Funcs;

class CauserResolver extends \Spatie\Activitylog\CauserResolver {

	public function __construct() {
		$this->authManager = Auth::instance()->getAuth();
		$this->authDriver  = Funcs::config('activitylog.default_auth_driver');

		// Set causer bằng User WP đã đăng nhập.
//		$this->setCauser(WPUsersModel::find(get_current_user_id()));
	}

}
