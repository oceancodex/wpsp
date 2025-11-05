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
final class Version20251105003015_create_queue_tables extends AbstractMigration {

//	protected $connection = 'mongodb';

    public function getDescription(): string {
        return 'Create Laravel-style queue tables (jobs, failed_jobs, job_batches)';
    }

    public function up(Schema $schema): void {
        // jobs
        $jobs = $schema->createTable(Funcs::getDBCustomMigrationTableName('jobs'));
        $jobs->addColumn('id', 'bigint', ['autoincrement' => true, 'unsigned' => true]);
        $jobs->setPrimaryKey(['id'], 'pk_jobs_id');

        $jobs->addColumn('queue', 'string', ['length' => 255]);
        $jobs->addIndex(['queue'], 'idx_jobs_queue');

        $jobs->addColumn('payload', 'text', ['length' => 4294967295]);
        $jobs->addColumn('attempts', 'smallint', ['unsigned' => true, 'default' => 0]);
        $jobs->addColumn('reserved_at', 'integer', ['unsigned' => true, 'notnull' => false]);
        $jobs->addColumn('available_at', 'integer', ['unsigned' => true]);
        $jobs->addColumn('created_at', 'integer', ['unsigned' => true]);

        // failed_jobs
        $failed = $schema->createTable(Funcs::getDBCustomMigrationTableName('failed_jobs'));
        $failed->addColumn('id', 'bigint', ['autoincrement' => true, 'unsigned' => true]);
        $failed->setPrimaryKey(['id'], 'pk_failed_jobs_id');

        $failed->addColumn('uuid', 'string', ['length' => 255]);
        $failed->addUniqueIndex(['uuid'], 'uidx_failed_jobs_uuid');

        $failed->addColumn('connection', 'text', ['notnull' => false]);
        $failed->addColumn('queue', 'text', ['notnull' => false]);
        $failed->addColumn('payload', 'text', ['length' => 4294967295]);
        $failed->addColumn('exception', 'text', ['length' => 4294967295]);
        $failed->addColumn('failed_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);

        // job_batches
        $batches = $schema->createTable(Funcs::getDBCustomMigrationTableName('job_batches'));
        $batches->addColumn('id', 'string', ['length' => 255]);
        $batches->setPrimaryKey(['id'], 'pk_job_batches_id');

        $batches->addColumn('name', 'string', ['length' => 255]);
        $batches->addColumn('total_jobs', 'integer', ['unsigned' => true]);
        $batches->addColumn('pending_jobs', 'integer', ['unsigned' => true]);
        $batches->addColumn('failed_jobs', 'integer', ['unsigned' => true, 'default' => 0]);
        $batches->addColumn('failed_job_ids', 'text', ['notnull' => false]);
        $batches->addColumn('options', 'text', ['notnull' => false]);
        $batches->addColumn('cancelled_at', 'integer', ['unsigned' => true, 'notnull' => false]);
        $batches->addColumn('created_at', 'integer', ['unsigned' => true, 'notnull' => false]);
        $batches->addColumn('finished_at', 'integer', ['unsigned' => true, 'notnull' => false]);
        $batches->addIndex(['finished_at'], 'idx_job_batches_finished_at');
    }

    public function down(Schema $schema): void {
	    $schema->dropTable(Funcs::getDBTableName('job_batches'));
	    $schema->dropTable(Funcs::getDBTableName('failed_jobs'));
	    $schema->dropTable(Funcs::getDBTableName('jobs'));
    }
}
