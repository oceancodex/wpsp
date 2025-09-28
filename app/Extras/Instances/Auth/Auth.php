<?php

namespace WPSP\app\Extras\Instances\Auth;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Auth\DBAuthUser;

class Auth extends \WPSPCORE\Auth\Auth {

	use InstancesTrait;

	/*
	 *
	 */

	public static ?self $instance = null;
	public static $DBAuthUser = null;

	/*
	 *
	 */

	public static function instance(): ?self {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return static::$instance;
	}

	/*
	 *
	 */

	/**
	 * @return array|\Illuminate\Database\Eloquent\Model|DBAuthUser|null
	 */
	public static function user() {
		$user = static::instance()->guard()->user();
		if ($user instanceof \stdClass) {
			// Bọc stdClass thành đối tượng DBAuthUser để có API: can(), roles(), permissions(), ...
			if (!static::$DBAuthUser || !(static::$DBAuthUser instanceof DBAuthUser) || static::$DBAuthUser->raw !== $user) {
				static::$DBAuthUser = new DBAuthUser(
					Funcs::instance()->_getMainPath(),
					Funcs::instance()->_getRootNamespace(),
					Funcs::instance()->_getPrefixEnv(),
					['user' => $user]
				);
			}
			return static::$DBAuthUser;
		}
		return $user;
	}

	public static function check(): bool {
		return static::instance()->guard()->check();
	}

	public static function logout(): void {
		static::instance()->guard()->logout();
		static::$DBAuthUser = null;
	}

	public static function id(): ?int {
		$user = static::user();
		if ($user && method_exists($user, 'id')) {
			return $user->id();
		}
		return static::instance()->guard()->id();
	}

}