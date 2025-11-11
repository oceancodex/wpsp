<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\App\Models\PermissionsModel;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSeeder;

class PermissionsSeeder extends BaseSeeder {

	use InstancesTrait, WithoutModelEvents;

	public function run() {
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