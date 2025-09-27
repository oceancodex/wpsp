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
final class Version20240628173353_create_users_table extends AbstractMigration {

	public function getDescription(): string {
		return '';
	}

	public function up(Schema $schema): void {

		/** Create new database table */
		$table = $schema->createTable(Funcs::getDBCustomMigrationTableName('users'));
		$table->addColumn('id', 'integer', ['autoincrement' => true]);
		$table->setPrimaryKey(['id'], 'wpsp_pk_users_id');

		$table->addColumn('name', 'string', ['length' => 255]);
		$table->addColumn('username', 'string', ['length' => 100]);
		$table->addUniqueIndex(['username'], 'wpsp_uq_users_username');

		$table->addColumn('email','string', ['length' => 255]);
		$table->addUniqueIndex(['email'], 'wpsp_uq_users_email');

		$table->addColumn('password','string', ['length' => 255]);

		$table->addColumn('email_verified_at', 'datetime', ['notnull' => false]);
		$table->addColumn('remember_token', 'string', ['length' => 100, 'notnull' => false]);

		$table->addColumn('status', 'string', ['length' => 50, 'default' => 'active']); // active, inactive, banned
		$table->addColumn('last_login_at', 'datetime', ['notnull' => false]);
		$table->addColumn('last_login_ip', 'string', ['length' => 45, 'notnull' => false]);

		/** When you create a new database table, you must create these columns "created_at", "updated_at", "deleted_at" */
		$table->addColumn('created_at', 'datetime', ['notnull' => false]);
		$table->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$table->addColumn('deleted_at', 'datetime', ['notnull' => false]);

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
