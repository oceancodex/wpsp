<?php
declare(strict_types=1);
namespace WPSP\database\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use WPSP\Funcs;

/**
 * All tables must use the prefix: "wp_wpsp_cm_" (Eg: wp_wpsp_cm_my_custom_table).
 * You can do it by use the function: Funcs::getDBCustomMigrationTableName('my_custom_table')
 * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#mapping-matrix
 * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/schema-representation.html#column
 */
final class Version20240628173353_create_users_table extends AbstractMigration {

	public function getDescription(): string {
		return '';
	}

	public function up(Schema $schema): void {

		/** Create new database table */
		$tableUsers = $schema->createTable(Funcs::getDBCustomMigrationTableName('users'));
		$tableUsers->addColumn('id', 'integer', ['autoincrement' => true]);
		$tableUsers->setPrimaryKey(['id'], 'wpsp_pk_users_id');

		$tableUsers->addColumn('name', 'string', ['length' => 255]);
		$tableUsers->addColumn('username', 'string', ['length' => 100]);
		$tableUsers->addUniqueIndex(['username'], 'wpsp_uq_users_username');

		$tableUsers->addColumn('email','string', ['length' => 255]);
		$tableUsers->addUniqueIndex(['email'], 'wpsp_uq_users_email');

		$tableUsers->addColumn('password','string', ['length' => 255]);

		$tableUsers->addColumn('email_verified_at', 'datetime', ['notnull' => false]);
		$tableUsers->addColumn('remember_token', 'string', ['length' => 100, 'notnull' => false]);
		$tableUsers->addColumn('api_token', 'string', ['length' => 80, 'notnull' => false])->setDefault(null);

		$tableUsers->addColumn('status', 'string', ['length' => 50, 'default' => 'active']); // active, inactive, banned
		$tableUsers->addColumn('last_login_at', 'datetime', ['notnull' => false]);
		$tableUsers->addColumn('last_login_ip', 'string', ['length' => 45, 'notnull' => false]);

		/** When you create a new database table, you must create these columns "created_at", "updated_at", "deleted_at" */
		$tableUsers->addColumn('created_at', 'datetime', ['notnull' => false]);
		$tableUsers->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$tableUsers->addColumn('deleted_at', 'datetime', ['notnull' => false]);

		/*
		 *
		 */

		/** password_reset_tokens (email primary, token, created_at) */
		$tablePasswordResetTokens = $schema->createTable(Funcs::getDBCustomMigrationTableName('password_reset_tokens'));
		$tablePasswordResetTokens->addColumn('email', 'string', ['length' => 255]);
		$tablePasswordResetTokens->addColumn('token', 'string', ['length' => 255]);
		$tablePasswordResetTokens->addColumn('created_at', 'datetime', ['notnull' => false]);
		$tablePasswordResetTokens->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$tablePasswordResetTokens->addColumn('deleted_at', 'datetime', ['notnull' => false]);
		$tablePasswordResetTokens->setPrimaryKey(['email'], 'wpsp_pk_password_reset_tokens_email');

		/** sessions table */
		$tableSessions = $schema->createTable(Funcs::getDBCustomMigrationTableName('sessions'));
		$tableSessions->addColumn('id', 'string', ['length' => 255]);
		$tableSessions->setPrimaryKey(['id'], 'wpsp_pk_sessions_id');

		$tableSessions->addColumn('user_id', 'integer', ['notnull' => false]);
		$tableSessions->addIndex(['user_id'], 'wpsp_idx_sessions_user_id');

		$tableSessions->addColumn('ip_address', 'string', ['length' => 45, 'notnull' => false]);
		$tableSessions->addColumn('user_agent', 'text', ['notnull' => false]);
		$tableSessions->addColumn('payload', 'text', ['length' => 4294967295]); // longText equivalent
		$tableSessions->addColumn('last_activity', 'integer');
		$tableSessions->addIndex(['last_activity'], 'wpsp_idx_sessions_last_activity');

		$tableSessions->addColumn('created_at', 'datetime', ['notnull' => false]);
		$tableSessions->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$tableSessions->addColumn('deleted_at', 'datetime', ['notnull' => false]);


//	    $table = $schema->getTable(Funcs::getDBCustomMigrationTableName('my_custom_table'));
//		$table->addColumn('some_column', 'text', ['notnull' => false]);
//		$table->addColumn('name', 'text')->setColumnDefinition('TEXT NULL AFTER `id`');

		/** Foreign keys */
//		$table->addForeignKeyConstraint('authors', ['author_id'], ['id'], ['onUpdate' => 'CASCADE']);
	}

	public function down(Schema $schema): void {
	    $schema->dropTable(Funcs::getDBCustomMigrationTableName('users'));
	}

}
