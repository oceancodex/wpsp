<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\UsersModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class UsersSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
//		$faker = Faker::create('vi_VN');
		$faker = Funcs::faker();

//		for ($i = 0; $i < 1; $i++) {
			$user1 = UsersModel::query()->create([
				'name'     => $faker->name,
				'username' => 'admin',
				'email'    => $faker->email,
				'password' => wp_hash_password('123@123##'),
			]);
			$user1->assignRole('admin');
			$user1->assignRole('super_admin');
			$user1->givePermissionTo('system_analytics');

			$user2 = UsersModel::query()->create([
				'name'     => $faker->name,
				'username' => 'moderator',
				'email'    => $faker->email,
				'password' => wp_hash_password('123@123##'),
			]);
			$user2->assignRole('api_moderator');
//		}
	}

}