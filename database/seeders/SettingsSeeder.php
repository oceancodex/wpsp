<?php

namespace WPSP\database\seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use WPSP\App\Models\SettingsModel;

class SettingsSeeder extends Seeder {

	use WithoutModelEvents;

	public function run() {
		$faker = Factory::create('vi_VN');

		for ($i = 0; $i < 20; $i++) {
			SettingsModel::query()->create([
				'key'   => Str::slug($faker->name, '_'),
				'value' => $faker->name
			]);
		}
	}

}