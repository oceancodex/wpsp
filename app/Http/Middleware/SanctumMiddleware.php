<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Extras\Instances\Sanctum\Sanctum;
use WPSPCORE\Base\BaseMiddleware;
use WPSPCORE\Sanctum\Exceptions\MissingAbilityException;
use WPSP\app\Traits\InstancesTrait;

class SanctumMiddleware extends BaseMiddleware {

	use InstancesTrait;

	public function handle($request): bool {
		$sanctum = Sanctum::instance();
		return $sanctum->check();
	}

	public function getPosts($request): bool {
		$sanctum = Sanctum::instance();

		if (!$sanctum->check()) {
			return false;
		}

		$user = $sanctum->user();

		// Check token abilities (if using token guard)
		if ($sanctum->usingTokenGuard() && method_exists($user, 'tokenCan')) {
			if (!$user->tokenCan('read:posts')) {
				return false;
			}
		}

		// Check user permissions (if using permission system)
		if (method_exists($user, 'can')) {
			if (!$user->can('read_posts')) {
				return false;
			}
		}

		return true;
	}

	public function createPost($request): bool {
		$sanctum = Sanctum::instance();

		if (!$sanctum->check()) {
			throw new \Exception('Unauthenticated', 401);
		}

		$user = $sanctum->user();

		// Check token abilities
		if ($sanctum->usingTokenGuard() && method_exists($user, 'tokenCan')) {
			if (!$user->tokenCan('create:posts')) {
				throw new MissingAbilityException(['create:posts']);
			}
		}

		// Check user permissions
		if (method_exists($user, 'can')) {
			if (!$user->can('create_posts')) {
				throw new \Exception('Insufficient permissions', 403);
			}
		}

		return true;
	}

	public function tokenOnly($request): bool {
		$sanctum = Sanctum::instance();

		if (!$sanctum->check()) {
			throw new \Exception('Unauthenticated', 401);
		}

		if (!$sanctum->usingTokenGuard()) {
			throw new \Exception('Token authentication required', 401);
		}

		return true;
	}

	public function sessionOnly($request): bool {
		$sanctum = Sanctum::instance();

		if (!$sanctum->check()) {
			throw new \Exception('Unauthenticated', 401);
		}

		if (!$sanctum->usingSessionGuard()) {
			throw new \Exception('Session authentication required', 401);
		}

		return true;
	}

}