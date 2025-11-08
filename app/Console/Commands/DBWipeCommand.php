<?php

namespace WPSP\app\Console\Commands;

use Illuminate\Database\Console\WipeCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DBWipeCommand extends WipeCommand {

	protected $name        = 'db:wipe';
	protected $description = 'Drop all tables with a specific prefix from the database.';

	public function handle() {
		$database   = $this->option('database') ?: config('database.default');
		$connection = DB::connection($database);
		$prefix     = $connection->getTablePrefix();

		if (empty($prefix)) {
			$this->components->error("No prefix configured for connection [{$database}]. Aborting to protect WordPress tables.");
			return;
		}

		$dbName = $connection->getDatabaseName();

		// ✅ Native query để liệt kê các bảng có prefix
		$tables = $connection->select("
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = ? 
              AND table_name LIKE ?
        ", [$dbName, $prefix . '%']);

		$tableNames = array_map(fn($t) => $t->table_name, $tables);

		if (empty($tableNames)) {
			$this->components->info("No tables found with prefix [{$prefix}] in [{$dbName}].");
			return;
		}

		$this->components->warn("Dropping tables with prefix [{$prefix}] on connection [{$database}]...");

		Schema::connection($database)->disableForeignKeyConstraints();

		foreach ($tableNames as $table) {
			$connection->statement("DROP TABLE IF EXISTS `$table`");
		}

		Schema::connection($database)->enableForeignKeyConstraints();

		$this->components->info("Dropped " . count($tableNames) . " tables with prefix [{$prefix}].");
	}

}
