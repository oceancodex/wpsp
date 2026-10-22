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
		return false;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(WPUsersModel $user, UsersModel $usersModel) {
		if (current_user_can('manage_options')) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(UsersModel $user) {
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(WPUsersModel $user, UsersModel $usersModel) {
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(WPUsersModel $user, UsersModel $usersModel) {
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(WPUsersModel $user, UsersModel $usersModel) {
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(WPUsersModel $user, UsersModel $usersModel) {
		return false;
	}

}
