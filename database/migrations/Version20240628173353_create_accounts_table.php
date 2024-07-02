<?php
declare(strict_types=1);
namespace WPSP\database\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use WPSP\Funcs;

/**
 * All tables must use the prefix: "wp_wpsp_cm_" (Eg: wp_wpsp_cm_my_custom_table).
 */

final class Version20240628173353_create_accounts_table extends AbstractMigration {

    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
	    $table = $schema->createTable(Funcs::instance()->_getDBCustomMigrationTableName('accounts'));
	    $table->addColumn('id', 'integer', ['autoincrement' => true]);
		$table->setPrimaryKey(['id'], 'id');

//	    $table = $schema->getTable(Funcs::instance()->_getDBCustomMigrationTableName('my_custom_table'));

//		$table->addForeignKeyConstraint('authors', ['author_id'], ['id']);
    }

    public function down(Schema $schema): void {
//	    $schema->dropTable(_dbTableName('my_custom_table'));
    }

}
