<?php

namespace WPSP\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSeeder;

final class DatabaseSeeder extends BaseSeeder {
	use WithoutModelEvents, InstancesTrait;

	public function run(): void {
		$this->call([
			SettingsSeeder::class,
			AccountsSeeder::class,
		]);
	}

}