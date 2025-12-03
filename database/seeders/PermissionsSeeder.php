<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder {

	use WithoutModelEvents;

	public function run() {
//		$faker = Faker::create('vi_VN');
//		$faker = Funcs::faker();

//		for ($i = 0; $i < 20; $i++) {
			Permission::query()->create([
				'name'       => 'edit_articles',
				'guard_name' => 'web'
			]);

			Permission::query()->create([
				'name'       => 'system_analytics',
				'guard_name' => 'web'
			]);

			Permission::query()->create([
				'name'       => 'edit_admins',
				'guard_name' => 'web'
			]);

			Permission::query()->create([
				'name'       => 'api_edit_articles',
				'guard_name' => 'api'
			]);
//		}
	}

}