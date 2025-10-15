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
final class Version20250926045029_create_permission_tables extends AbstractMigration {

	public function getDescription(): string {
		return 'Create permissions, roles and pivot tables';
	}

	public function up(Schema $schema): void {
		// permissions table
		$permissions = $schema->createTable(Funcs::getDBCustomMigrationTableName('permissions'));
		$permissions->addColumn('id', 'bigint', ['autoincrement' => true]);
		$permissions->addColumn('name', 'string', ['length' => 255, 'notnull' => true]);
		$permissions->addColumn('guard_name', 'string', ['length' => 100, 'notnull' => true]);
		$permissions->addColumn('created_at', 'datetime', ['notnull' => false]);
		$permissions->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$permissions->addColumn('deleted_at', 'datetime', ['notnull' => false]);
		$permissions->setPrimaryKey(['id']);
		$permissions->addUniqueIndex(['name', 'guard_name']);

		// roles table
		$roles = $schema->createTable(Funcs::getDBCustomMigrationTableName('roles'));
		$roles->addColumn('id', 'bigint', ['autoincrement' => true]);
		$roles->addColumn('name', 'string', ['length' => 255, 'notnull' => true]);
		$roles->addColumn('guard_name', 'string', ['length' => 100, 'notnull' => true]);
		$roles->addColumn('created_at', 'datetime', ['notnull' => false]);
		$roles->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$roles->addColumn('deleted_at', 'datetime', ['notnull' => false]);
		$roles->setPrimaryKey(['id']);
		$roles->addUniqueIndex(['name', 'guard_name']);

		// role_has_permissions pivot
		$rolePermissions = $schema->createTable(Funcs::getDBCustomMigrationTableName('role_has_permissions'));
		$rolePermissions->addColumn('permission_id', 'bigint');
		$rolePermissions->addColumn('role_id', 'bigint');
		$rolePermissions->addColumn('created_at', 'datetime', ['notnull' => false]);
		$rolePermissions->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$rolePermissions->addColumn('deleted_at', 'datetime', ['notnull' => false]);
		$rolePermissions->setPrimaryKey(['permission_id', 'role_id']);
		$rolePermissions->addForeignKeyConstraint(Funcs::getDBCustomMigrationTableName('permissions'), ['permission_id'], ['id'], ['onDelete' => 'CASCADE']);
		$rolePermissions->addForeignKeyConstraint(Funcs::getDBCustomMigrationTableName('roles'), ['role_id'], ['id'], ['onDelete' => 'CASCADE']);

		// model_has_roles
		$modelHasRoles = $schema->createTable(Funcs::getDBCustomMigrationTableName('model_has_roles'));
		$modelHasRoles->addColumn('role_id', 'bigint');
		$modelHasRoles->addColumn('model_type', 'string', ['length' => 255]);
		$modelHasRoles->addColumn('model_id', 'bigint');
		$modelHasRoles->addColumn('created_at', 'datetime', ['notnull' => false]);
		$modelHasRoles->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$modelHasRoles->addColumn('deleted_at', 'datetime', ['notnull' => false]);
		$modelHasRoles->setPrimaryKey(['role_id', 'model_id', 'model_type']);
		$modelHasRoles->addIndex(['model_id', 'model_type']);
		$modelHasRoles->addForeignKeyConstraint(Funcs::getDBCustomMigrationTableName('roles'), ['role_id'], ['id'], ['onDelete' => 'CASCADE']);

		// model_has_permissions
		$modelHasPermissions = $schema->createTable(Funcs::getDBCustomMigrationTableName('model_has_permissions'));
		$modelHasPermissions->addColumn('permission_id', 'bigint');
		$modelHasPermissions->addColumn('model_type', 'string', ['length' => 255]);
		$modelHasPermissions->addColumn('model_id', 'bigint');
		$modelHasPermissions->addColumn('created_at', 'datetime', ['notnull' => false]);
		$modelHasPermissions->addColumn('updated_at', 'datetime', ['notnull' => false]);
		$modelHasPermissions->addColumn('deleted_at', 'datetime', ['notnull' => false]);
		$modelHasPermissions->setPrimaryKey(['permission_id', 'model_id', 'model_type']);
		$modelHasPermissions->addIndex(['model_id', 'model_type']);
		$modelHasPermissions->addForeignKeyConstraint(Funcs::getDBCustomMigrationTableName('permissions'), ['permission_id'], ['id'], ['onDelete' => 'CASCADE']);
	}

	public function down(Schema $schema): void {
		$schema->dropTable(Funcs::getDBCustomMigrationTableName('model_has_permissions'));
		$schema->dropTable(Funcs::getDBCustomMigrationTableName('model_has_roles'));
		$schema->dropTable(Funcs::getDBCustomMigrationTableName('role_has_permissions'));
		$schema->dropTable(Funcs::getDBCustomMigrationTableName('roles'));
		$schema->dropTable(Funcs::getDBCustomMigrationTableName('permissions'));
	}

}
