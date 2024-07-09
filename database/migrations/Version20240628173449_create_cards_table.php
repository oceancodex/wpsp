<?php
declare(strict_types=1);
namespace WPSP\database\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use WPSP\Funcs;

/**
 * All tables must use the prefix: "wp_wpsp_cm_" (Eg: wp_wpsp_cm_my_custom_table).
 */
final class Version20240628173449_create_cards_table extends AbstractMigration {

    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
//	    $table = $schema->createTable(Funcs::getDBCustomMigrationTableName('cards'));
//	    $table->addColumn('id', 'integer', ['autoincrement' => true]);
//		$table->setPrimaryKey(['id'], 'id');

//	    $table = $schema->getTable(Funcs::getDBCustomMigrationTableName('my_custom_table'));

//		$table->addForeignKeyConstraint('authors', ['author_id'], ['id']);
    }

    public function down(Schema $schema): void {
	    $schema->dropTable(Funcs::getDBCustomMigrationTableName('cards'));
    }

}
