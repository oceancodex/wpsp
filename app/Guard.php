<?php
namespace WPSP\app;

class Guard {
	protected $provider;
	protected $session_key = 'wpsp_user_id';

	public function __construct(UserProvider $provider) {
		$this->provider = $provider;
	}

	public function attempt($credentials) {
		$user = $this->provider->retrieveByCredentials($credentials);
		if ($user && wp_check_password($credentials['password'], $user->user_pass)) {
			$_SESSION[$this->session_key] = $user->ID;
			return true;
		}
		return false;
	}

	public function user() {
		if (!empty($_SESSION[$this->session_key])) {
			return $this->provider->retrieveById($_SESSION[$this->session_key]);
		}
		return null;
	}

	public function check() {
		return $this->user() !== null;
	}

	public function logout() {
		unset($_SESSION[$this->session_key]);
	}
}
