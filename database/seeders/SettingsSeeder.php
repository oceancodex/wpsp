<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class SettingsSeeder extends BaseSeeder {

	use InstancesTrait, WithoutModelEvents;

	public function run() {
//		$faker = Faker::create('vi_VN');
		$faker = Funcs::faker();

		for ($i = 0; $i < 20; $i++) {
			SettingsModel::query()->create([
				'key'   => $faker->userName ?? 'key_' . time(),
				'value' => $faker->name ?? 'value_' . time()
			]);
		}
	}

}