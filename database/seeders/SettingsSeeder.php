<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Models\Settings;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSeeder;

class SettingsSeeder extends BaseSeeder {

	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
//		$faker = \Faker\Factory::create();
//
//		for ($i = 0; $i < 20; $i++) {
//			Settings::create([
//				'key'   => $faker->userName,
//				'value' => $faker->name
//			]);
//		}
	}

}