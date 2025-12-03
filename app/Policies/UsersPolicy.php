<?php

namespace WPSP\App\Policies;

use Illuminate\Auth\Access\Response;
use WPSP\App\Models\UsersModel;

class UsersPolicy {

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(UsersModel $user): bool {
		return false;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(UsersModel $user, UsersModel $usersModel): bool {
		if (current_user_can('manage_options')) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(UsersModel $user): bool {
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(UsersModel $user, UsersModel $usersModel): bool {
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(UsersModel $user, UsersModel $usersModel): bool {
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(UsersModel $user, UsersModel $usersModel): bool {
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(UsersModel $user, UsersModel $usersModel): bool {
		return false;
	}

}
