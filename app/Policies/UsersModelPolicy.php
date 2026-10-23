<?php

namespace WPSP\App\Policies;

use Illuminate\Auth\Access\Response;
use WPSP\App\Models\UsersModel;
use WPSP\App\Models\WPUsersModel;

class UsersModelPolicy {

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(WPUsersModel $user) {
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(UsersModel|WPUsersModel $user, ?UsersModel $usersModel = null) {
		if (current_user_can('manage_options')) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(UsersModel|WPUsersModel $user) {
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(UsersModel|WPUsersModel $user, ?UsersModel $usersModel = null) {
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(UsersModel|WPUsersModel $user, ?UsersModel $usersModel = null) {
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(UsersModel|WPUsersModel $user, ?UsersModel $usersModel = null) {
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(UsersModel|WPUsersModel $user, ?UsersModel $usersModel = null) {
		return false;
	}

}
