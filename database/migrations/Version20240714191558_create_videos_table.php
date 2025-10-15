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
final class Version20240714191558_create_videos_table extends AbstractMigration {

//	protected $connection = 'wpsp_mongodb';

    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {

        /** Create new database table */
//	    $table = $schema->createTable(Funcs::getDBCustomMigrationTableName('videos'));
//	    $table->addColumn('id', 'integer', ['autoincrement' => true]);
//		$table->setPrimaryKey(['id'], 'id');

//		$table->addColumn('title','string', ['length' => 255, 'notnull' => false]);

		/** When you create a new database table, you must create these columns "created_at", "updated_at", "deleted_at" */
//		$table->addColumn('created_at', 'datetime', ['notnull' => false]);
//		$table->addColumn('updated_at', 'datetime', ['notnull' => false]);
//		$table->addColumn('deleted_at', 'datetime', ['notnull' => false]);

		/** Get the exist table and working on it */
//	    $table = $schema->getTable(Funcs::getDBCustomMigrationTableName('my_custom_table'));
//		$table->addColumn('some_column', 'text', ['notnull' => false]);
//		$table->addColumn('name', 'text')->setColumnDefinition('TEXT NULL AFTER `id`');

		/** Foreign keys */
//		$table->addForeignKeyConstraint('authors', ['author_id'], ['id'], ['onUpdate' => 'CASCADE']);
    }

    public function down(Schema $schema): void {
//	    $schema->dropTable(Funcs::getDBCustomMigrationTableName('my_custom_table'));
    }

}
