<?php

namespace WPSP\app\Http\Controllers;

use WPSPCORE\Base\BaseController;
use WPSPCORE\Objects\Database\Eloquent;
use WPSPCORE\Objects\Database\Migration;

class AjaxController extends BaseController {

	public function handleDatabase(): void {
		$nonce = self::$request->get('nonce');
		if (!wp_verify_nonce($nonce, config('app.short_name'))) die('Busted!');

		$type = self::$request->get('type');

		if ($type == 'check_all_database_table_exists') {
			$migationFolderNotEmpty = Migration::checkMigrationFolderNotEmpty();
			if ($migationFolderNotEmpty) {
				wp_send_json(_response(
					true,
					['actions' => ['database_drop', 'migration_migrate']],
					'Refreshing database...',
					200
				));
			}
			else {
				wp_send_json(_response(
					true,
					['actions' => ['database_drop', 'migration_diff', 'migration_migrate']],
					'Do not have any migrations. Try refreshing database and migrations...',
					200
				));
			}
		}
		elseif ($type == 'check_migration_folder_not_empty') {
			wp_send_json(_response(
				true,
				['actions' => ['database_drop', 'migration_diff', 'migration_migrate']],
				'Refreshing database and migrations...',
				200
			));
		}
		elseif ($type == 'check_database_version_newest') {
			wp_send_json(_response(
				true,
				['actions' => ['migration_migrate']],
				'Updating database...',
				200
			));
		}
		elseif ($type == 'regenerate_database_and_migrations') {
			wp_send_json(_response(
				true,
				['actions' => ['database_drop', 'migration_delete_all', 'migration_diff', 'migration_migrate']],
				'Re-generating database and migrations...',
				200
			));
		}

		if ($type == 'database_drop') {
			$result            = Eloquent::dropAllDatabaseTables();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
		elseif ($type == 'migration_diff') {
			$result            = Migration::diff();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
		elseif ($type == 'migration_migrate') {
			$result            = Migration::migrate();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
		elseif ($type == 'migration_delete_all') {
			$result            = Migration::deleteAllMigrations();
			$result['message'] = '<div>' . $result['message'] . '</div>';
			wp_send_json($result);
		}
	}

	public function demoAjaxGet(): void {
		wp_send_json(_response(true, null, 'Demo ajax get!', 200));
	}

}