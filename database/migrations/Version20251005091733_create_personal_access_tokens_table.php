<?php
declare(strict_types=1);
namespace WPSP\database\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use WPSP\Funcs;

/**
 * All tables must use the prefix: "wp_wpsp_cm_" (Eg: wp_wpsp_cm_my_custom_table).
 * You can do it by use the function: Funcs::getDBCustomMigrationTableName('my_custom_table')
 */
final class Version20251005091733_create_personal_access_tokens_table extends AbstractMigration {

	public function getDescription(): string {
		return 'Create table: personal_access_tokens (Laravel Sanctum equivalent)';
	}

	public function up(Schema $schema): void {

		/** Create new database table */
		$table = $schema->createTable(Funcs::getDBCustomMigrationTableName('personal_access_tokens'));

		$table->addColumn('id', 'integer', ['autoincrement' => true]);
		$table->setPrimaryKey(['id'], 'wpsp_pk_personal_access_tokens_id');

		$table->addColumn('tokenable_type', 'string', ['length' => 255]);
		$table->addColumn('tokenable_id', 'integer');
		$table->addIndex(['tokenable_type', 'tokenable_id'], 'wpsp_idx_pat_tokenable_type_id');

		$table->addColumn('name', 'text');
//		$table->addUniqueIndex(['tokenable_id', 'name'], 'wpsp_uq_personal_access_tokens_name');

		$table->addColumn('token', 'string', ['length' => 64]);
		$table->addUniqueIndex(['token'], 'wpsp_uq_personal_access_tokens_token');

		$table->addColumn('refresh_token', 'string', ['length' => 64]);
		$table->addUniqueIndex(['refresh_token'], 'wpsp_uq_personal_access_tokens_refresh_token');

		$table->addColumn('abilities', 'text', ['notnull' => false]);

		$table->addColumn('last_used_at', 'datetime', ['notnull' => false]);

		$table->addColumn('expires_at', 'datetime', ['notnull' => false]);
		$table->addIndex(['expires_at'], 'wpsp_idx_personal_access_tokens_expires_at');

		$table->addColumn('refresh_token_expires_at', 'datetime', ['notnull' => false]);
		$table->addIndex(['refresh_token_expires_at'], 'wpsp_idx_personal_access_tokens_refresh_token_expires_at');

		/** Common timestamp columns */
		$table->addColumn('created_at', 'datetime', ['notnull' => false]);
		$table->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$table->addColumn('deleted_at', 'datetime', ['notnull' => false]);
	}

	public function down(Schema $schema): void {
		$schema->dropTable(Funcs::getDBCustomMigrationTableName('personal_access_tokens'));
	}

}
