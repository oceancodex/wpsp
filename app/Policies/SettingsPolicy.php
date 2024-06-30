<?php

namespace WPSP\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use WPSP\app\Models\Settings;
use WPSP\app\Models\Users;

class SettingsPolicy {

	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param Users $user
	 *
	 * @return void
	 */
	public function viewAny(Users $user): bool {
		return false;
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param Users          $user
	 * @param Settings $setting
	 *
	 * @return bool
	 */
	public function view(Users $user, Settings $setting): bool {
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param Users $user
	 *
	 * @return void
	 */
	public function create(Users $user): void {
		//
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param Users          $user
	 * @param Settings $setting
	 *
	 * @return bool
	 */
	public function update(Users $user, Settings $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param Users          $user
	 * @param Settings $setting
	 *
	 * @return bool
	 */
	public function delete(Users $user, Settings $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param Users          $user
	 * @param Settings $setting
	 *
	 * @return bool
	 */
	public function restore(Users $user, Settings $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param Users          $user
	 * @param Settings $setting
	 *
	 * @return bool
	 */
	public function forceDelete(Users $user, Settings $setting): bool {
		return $user->id === $setting->getAttribute('user_id');
	}

}