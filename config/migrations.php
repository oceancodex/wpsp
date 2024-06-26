<?php
use WPSP\Funcs;

return [
	///////////////////////////////////
	'table_storage'    => [
		'table_name'                 => Funcs::instance()->_getDBTableName('migration_versions'),
		'version_column_name'        => 'version',
//		'version_column_length'      => 191,
		'executed_at_column_name'    => 'executed_at',
		'execution_time_column_name' => 'execution_time',
	],
	'migrations_paths' => [
		'WPSP\database\migrations' => __DIR__ . '/../database/migrations',
	],

	///////////////////////////////////

//	'migrations_namespace'    => '\WPSP\database\migrations',
//	'table_name'              => _dbTableName('migration_versions'),
//	'column_name'             => 'version',
////	'column_length'           => 14,
//	'executed_at_column_name' => 'executed_at',
//	'migrations_directory'    => __DIR__ . '/../database/migrations',

	///////////////////////////////////

	'all_or_nothing'          => true,
	'transactional'           => true,
	'check_database_platform' => true,
	'organize_migrations'     => 'none',
	'connection'              => null,
	'em'                      => null,
];