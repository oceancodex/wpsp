<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\AccountsModel;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSeeder;

class AccountsSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
		$faker = Faker::create();

		for ($i = 0; $i < 20; $i++) {
			AccountsModel::create([
				'name'  => $faker->name,
				'email' => $faker->email
			]);
		}
	}

}