<?php

namespace WPSP\database\seeders;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseSeeder;

final class DatabaseSeeder extends BaseSeeder {

	use InstancesTrait;

	public function run() {
		try {
			$this->call([
				SettingsSeeder::class,
//			    VideosSeeder::class,
				PermissionsSeeder::class,
				RolesSeeder::class,
				UsersSeeder::class,
			]);
		}
		catch (\Throwable $e) {
			if ($this->output) {
				$this->output->writeln('<fg=red>> Error: ' . $e->getMessage() . '</>');
				$this->output->writeln('');
			}
			else {
				echo '> Error: ' . $e->getMessage() . '\n';
			}
		}
	}

}