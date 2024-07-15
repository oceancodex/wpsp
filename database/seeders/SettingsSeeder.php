<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class SettingsSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
//		$faker = Faker::create('vi_VN');
		$faker = Funcs::faker();

		for ($i = 0; $i < 20; $i++) {
			SettingsModel::create([
				'key'   => $faker->userName,
				'value' => $faker->name
			]);
		}
	}

}