<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\PermissionsModel;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class PermissionsSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
//		$faker = Faker::create('vi_VN');
//		$faker = Funcs::faker();

//		for ($i = 0; $i < 20; $i++) {
			PermissionsModel::query()->create([
				'name'       => 'edit_articles',
				'guard_name' => 'web'
			]);

			PermissionsModel::query()->create([
				'name'       => 'system_analytics',
				'guard_name' => 'web'
			]);

			PermissionsModel::query()->create([
				'name'       => 'edit_admins',
				'guard_name' => 'web'
			]);

			PermissionsModel::query()->create([
				'name'       => 'api_edit_articles',
				'guard_name' => 'api'
			]);
//		}
	}

}