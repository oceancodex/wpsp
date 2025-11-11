<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\App\Models\VideosModel;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class VideosSeeder extends BaseSeeder {

	use InstancesTrait, WithoutModelEvents;

	public function run() {
//		$faker = Faker::create();
		$faker = Funcs::faker();

//		for ($i = 0; $i < 100; $i++) {
//			VideosModel::create([
//				'key'   => $faker->userName,
//				'value' => $faker->name
//			]);
//		}
	}

}