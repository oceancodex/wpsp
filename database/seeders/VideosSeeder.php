<?php

namespace WPSP\database\seeders;

use Faker\Factory as Faker;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseSeeder;

class VideosSeeder extends BaseSeeder {

	use InstancesTrait;

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