<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSP\app\Models\SettingsModel;
use WPSPCORE\Base\BaseSeeder;

class VideosSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
//		$faker = Faker::create();
		$faker = Funcs::faker();

		for ($i = 0; $i < 100; $i++) {
			VideosModel::create([
				'key'   => $faker->userName,
				'value' => $faker->name
			]);
		}
	}

}