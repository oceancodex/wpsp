<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use WPSP\App\Models\UsersModel;
use WPSP\App\Traits\InstancesTrait;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder {

	use InstancesTrait, WithoutModelEvents;

	public function run() {
		$faker = Faker::create('vi_VN');
//		$faker = Funcs::faker();

//		for ($i = 0; $i < 1; $i++) {
			$user1 = UsersModel::query()->create([
				'name'     => 'admin',
				'email'    => $faker->email,
				'password' => Hash::make('123@123##'),
			]);
//			$user1->assignRole('admin');
//			$user1->assignRole('super_admin');
//			$user1->assignRole('api_user', true);
//			$user1->givePermissionTo('system_analytics');

			$user2 = UsersModel::query()->create([
				'name'       => 'api_user',
				'email'      => $faker->email,
				'password'   => Hash::make('123@123##'),
			]);
//			$user2->guard_name = 'api';
//			$user2->assignRole('api_user');
//		}
	}

}