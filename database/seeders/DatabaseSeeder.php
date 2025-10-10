<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSPCORE\Base\BaseSeeder;

final class DatabaseSeeder extends BaseSeeder {
	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
		$this->call([
			SettingsSeeder::class,
//			VideosSeeder::class,
			PermissionsSeeder::class,
			RolesSeeder::class,
			UsersSeeder::class,
		]);
	}

}