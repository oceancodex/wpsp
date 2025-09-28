<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\RolesModel;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class RolesSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
//		$faker = Faker::create('vi_VN');
//		$faker = Funcs::faker();

//		for ($i = 0; $i < 20; $i++) {
			$role1 = RolesModel::query()->create([
				'name'       => 'admin',
				'guard_name' => 'admin'
			]);
			$role1->givePermissionTo('edit_articles');

			$role2 = RolesModel::query()->create([
				'name'       => 'super_admin',
				'guard_name' => 'super_admin'
			]);
			$role2->givePermissionTo('edit_admins');
//		}
	}

}