<?php

namespace WPSP\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class MigrateFreshCommand extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:migrate-fresh-command';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Execute the console command.
	 */
	public function handle() {
		//
	}

	protected function dropAllTables($database) {
		$connection = $this->laravel['db']->connection($database);
		$schema     = $connection->getDoctrineSchemaManager();

		// Lấy prefix từ config database connection
		$prefix = $connection->getTablePrefix();

		$tables = collect($schema->listTableNames())
			->filter(fn($table) => str_starts_with($table, $prefix))
			->values()
			->all();

		if (empty($tables)) {
			$this->components->info("No tables found with prefix [{$prefix}] in connection [{$database}].");
			return;
		}

		$this->components->warn("Dropping tables with prefix [{$prefix}] on connection [{$database}]...");

		Schema::connection($database)->disableForeignKeyConstraints();

		foreach ($tables as $table) {
			$connection->statement("DROP TABLE IF EXISTS `$table`");
		}

		Schema::connection($database)->enableForeignKeyConstraints();

		$this->components->info('Dropped all tables with prefix [' . $prefix . '].');
	}

}
