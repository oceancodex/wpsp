<?php

namespace WPSP\App\Http\Controllers;

use Illuminate\Http\Request;
use WPSP\App\Instances\Database\Migration;
use WPSP\App\Instances\RateLimiter\RateLimiter;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class AjaxsController extends BaseController {

	use InstancesTrait;

	public function handleDatabase() {
		$nonce = $this->request->get('nonce');
		if (!wp_verify_nonce($nonce, Funcs::config('app.short_name'))) die('Busted!');

		$type = $this->request->get('type');

		if ($type == 'check_all_database_table_exists') {
			$migationFolderNotEmpty = Migration::instance()->checkMigrationFolderNotEmpty();
			if ($migationFolderNotEmpty) {
				wp_send_json(Funcs::response(
					true,
					['actions' => ['database_drop', 'migration_migrate']],
					'Refreshing database...',
				));
			}
			else {
				wp_send_json(Funcs::response(
					true,
					['actions' => ['database_drop', 'migration_diff', 'migration_migrate']],
					'Do not have any migrations. Try refreshing database and migrations...',
				));
			}
		}
		elseif ($type == 'check_migration_folder_not_empty') {
			wp_send_json(Funcs::response(
				true,
				['actions' => ['database_drop', 'migration_diff', 'migration_migrate']],
				'Refreshing database and migrations...',
			));
		}
		elseif ($type == 'check_database_version_newest') {
			wp_send_json(Funcs::response(
				true,
				['actions' => ['migration_migrate']],
				'Updating database...',
			));
		}
		elseif ($type == 'regenerate_database_and_migrations') {
			wp_send_json(Funcs::response(
				true,
				['actions' => ['database_drop', 'migration_delete_all', 'migration_diff', 'migration_migrate']],
				'Re-generating database and migrations...',
			));
		}

		if ($type == 'database_drop') {
			$result            = Migration::instance()->dropAllDatabaseTables();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
		elseif ($type == 'migration_diff') {
			$result            = Migration::instance()->diff();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
		elseif ($type == 'migration_migrate') {
			$result            = Migration::instance()->migrate();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
		elseif ($type == 'migration_delete_all') {
			$result            = Migration::instance()->deleteAllMigrations();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
	}

	public function ajaxDemoGet(Request $request, $path, $fullPath) {
//		check_ajax_referer(Funcs::config('app.short_name'), 'nonce');

		// Rate limit for 10 requests per 60 seconds based on the user display name or request IP address.
		try {
			$rateLimitKey                        = 'ajax_demo_get_' . (wp_get_current_user()->display_name ?? $this->request->getClientIp());
			$rateLimitByUserDisplayName          = RateLimiter::attempt($rateLimitKey, 10, function() {});
			$rateLimitByUserDisplayNameRemaining = RateLimiter::remaining($rateLimitKey, 10);
			$rateLimitByUserDisplayNameAccepted  = $rateLimitByUserDisplayName;
		}
		catch (\Throwable $e) {
			$rateLimitByUserDisplayNameAccepted  = true;
			$rateLimitByUserDisplayNameRemaining = null;
		}

		if (false === $rateLimitByUserDisplayNameAccepted) {
			wp_send_json(Funcs::response(
				false,
				[
					'rate_limit_remaining' => $rateLimitByUserDisplayNameRemaining,
					'current_user_name'    => null
				],
				'Rate limit exceeded. Please try again later.',
			));
			exit;
		}

		wp_send_json(Funcs::response(
			true,
			[
				'rate_limit_remaining' => $rateLimitByUserDisplayNameRemaining,
				'current_user_name'    => wp_get_current_user()->display_name
			],
			'Demo ajax get!',
		));

	}

}