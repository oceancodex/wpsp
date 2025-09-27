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

		for ($i = 0; $i < 1; $i++) {
			UsersModel::create([
				'name'  => $faker->name,
				'username' => 'admin',
				'email' => $faker->email,
				'password' => wp_hash_password('123@123##'),
			]);
		}
	}

}