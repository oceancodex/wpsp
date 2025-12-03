<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder {

	use WithoutModelEvents;

	public function run() {
//		$faker = Faker::create('vi_VN');
//		$faker = Funcs::faker();

//		for ($i = 0; $i < 20; $i++) {
			$role1 = Role::query()->create([
				'name'       => 'super_admin',
				'guard_name' => 'web'
			]);
			$role1->givePermissionTo('edit_admins');
			$role1->givePermissionTo('edit_articles');

			$role2 = Role::query()->create([
				'name'       => 'admin',
				'guard_name' => 'web'
			]);
			$role2->givePermissionTo('edit_articles');

			$role3 = Role::query()->create([
				'name'       => 'api_user',
				'guard_name' => 'api'
			]);
			$role3->givePermissionTo('api_edit_articles');
//		}
	}

}