<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSPCORE\Base\BaseSeeder;

final class DatabaseSeeder extends BaseSeeder {
	use WithoutModelEvents;

	public function run() {
		try {
			$this->call([
				SettingsSeeder::class,
//			    VideosSeeder::class,
				PermissionsSeeder::class,
				RolesSeeder::class,
				UsersSeeder::class,
			]);
		}
		catch (\Exception|\Throwable $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

}