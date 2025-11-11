<?php

namespace WPSP\App\Console\Commands\Database\Seeds;

use WPSP\Funcs;

class SeedCommand extends \Illuminate\Database\Console\Seeds\SeedCommand {

	protected function getSeeder() {
		$class = $this->input->getArgument('class') ?? $this->input->getOption('class');

		// Lấy namespace root động từ plugin hiện tại
		$root = Funcs::instance()->_getRootNamespace();

		// Nếu chưa có root prefix, tự thêm
		if (strpos($class, $root) !== 0) {
			$class = "\\{$root}\\{$class}";
		}

		return $this->laravel->make($class)
			->setContainer($this->laravel)
			->setCommand($this);
	}

}
