<?php

namespace WPSP\App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use WPSP\App\Models\SettingsModel;
use WPSP\App\Models\UsersModel;
use WPSP\App\Models\WPUsersModel;

class SettingsModelPolicy {

	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(UsersModel|WPUsersModel|\WP_User $user) {
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(UsersModel|WPUsersModel|\WP_User $user, SettingsModel $model = null) {
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(UsersModel|WPUsersModel|\WP_User $user) {
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(UsersModel|WPUsersModel|\WP_User $user, SettingsModel $model = null) {
		return $user->id === $model->getAttribute('user_id');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(UsersModel|WPUsersModel|\WP_User $user, SettingsModel $model = null) {
		return $user->id === $model->getAttribute('user_id');
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(UsersModel|WPUsersModel|\WP_User $user, SettingsModel $model = null) {
		return $user->id === $model->getAttribute('user_id');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(UsersModel|WPUsersModel|\WP_User $user, SettingsModel $model = null) {
		return $user->id === $model->getAttribute('user_id');
	}

}
