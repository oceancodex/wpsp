<?php

namespace WPSP\App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use WPSP\App\Models\SettingsModel;
use WPSP\App\Models\UsersModel;

class SettingsPolicy {

	use HandlesAuthorization;

	public function viewAny(UsersModel $user): bool {
		return false;
	}

	public function view(UsersModel $user, SettingsModel $setting): bool {
		return false;
	}

	public function create(UsersModel $user): bool {
		return false;
	}

	public function update(UsersModel $user, SettingsModel $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

	public function delete(UsersModel $user, SettingsModel $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

	public function restore(UsersModel $user, SettingsModel $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

	public function forceDelete(UsersModel $user, SettingsModel $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

}