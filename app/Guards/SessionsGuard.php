<?php

namespace WPSP\app\Guards;

class SessionsGuard extends \WPSPCORE\Auth\Guards\SessionsGuard {

	public function attempt(array $credentials): bool {
		$user = $this->provider->retrieveByCredentials($credentials);
		if ($user && isset($credentials['password']) && wp_check_password($credentials['password'], $user->password)) {
			$_SESSION[$this->sessionKey] = (int)$user->id;
			return true;
		}
		return false;
	}

}