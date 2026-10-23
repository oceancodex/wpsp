<?php

namespace WPSP\App\Policies;

use Illuminate\Auth\Access\Response;
use WPSP\App\Models\UsersModel;
use WPSP\App\Models\WPUsersModel;

class ExamplePolicy {

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(UsersModel|WPUsersModel|\WP_User $user) {
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(UsersModel|WPUsersModel|\WP_User $user, $model = null) {
		if (current_user_can('manage_options')) {
			return true;
		}
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
	public function update(UsersModel|WPUsersModel|\WP_User $user, $model = null) {
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(UsersModel|WPUsersModel|\WP_User $user, $model = null) {
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(UsersModel|WPUsersModel|\WP_User $user, $model = null) {
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(UsersModel|WPUsersModel|\WP_User $user, $model = null) {
		return false;
	}

}
