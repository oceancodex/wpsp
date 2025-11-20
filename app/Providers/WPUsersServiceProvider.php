<?php

namespace WPSP\App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use WPSP\App\Models\WPUsersModel;

class WPUsersServiceProvider extends ServiceProvider {

	public function boot(): void {
		Auth::provider('wp_users', function($app, array $config) {
			return new class implements \Illuminate\Contracts\Auth\UserProvider {

				public function retrieveById($identifier): ?WPUsersModel {
					$user = get_user_by('id', $identifier);
					return $user ? new WPUsersModel($user) : null;
				}

				public function retrieveByToken($identifier, $token) {}

				public function updateRememberToken($user, $token) {}

				public function retrieveByCredentials(array $credentials): ?WPUsersModel {
					$login = $credentials['user_login'] ?? $credentials['user_email'] ?? null;
					if (!$login) return null;

					$user = get_user_by('login', $login) ?: get_user_by('email', $login);
					return $user ? new WPUsersModel($user) : null;
				}

				public function validateCredentials($user, array $credentials) {
					$password = $credentials['user_pass'] ?? $credentials['password'] ?? '';
					return wp_check_password($password, $user->getAuthPassword(), $user->ID);
				}

				public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false) {}

			};
		});
	}

}
