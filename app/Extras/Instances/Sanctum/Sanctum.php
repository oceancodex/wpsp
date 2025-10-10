<?php

namespace WPSP\app\Extras\Instances\Sanctum;

use WPSP\app\Extras\Instances\Auth\Auth;
use WPSP\Funcs;

class Sanctum extends \WPSPCORE\Sanctum\Sanctum {

	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	public static function instance(): ?self {
		if (!static::$instance) {

			$configs      = Funcs::config('auth') ?? [];
			$guardName    = 'sanctum';
			$guardConfig  = Funcs::config('auth.guards.sanctum') ?? null;
			$providerName = $guardConfig['provider'] ?? ($configs['defaults']['provider'] ?? 'users');
			$sessionKey   = Funcs::instance()->_getAppShortName() . '_auth_' . $guardName . '_session_user_id';

			$provider = Auth::makeProvider(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				$providerName,
				$configs
			);

			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'provider'     => $provider,
					'session_key'  => $sessionKey,
					'guard_name'   => $guardName,
					'guard_config' => $guardConfig,
				]
			));
		}
		return static::$instance;
	}

}