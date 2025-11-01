<?php

use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\ORMSetup;
use WPSP\app\Extras\Instances\Environment\Environment;
use WPSP\Funcs;
use WPSPCORE\Migration\TablePrefix;

try {
	/**
	 * Environment.
	 */
	Environment::init(__DIR__ . '/');

	/**
	 * Setups.
	 */
	$paths     = [__DIR__ . '/app/Entities', __DIR__ . '/database/migrations'];
	$config    = new PhpFile(__DIR__ . '/config/migrations.php');
	$isDevMode = Funcs::config('app.env') == 'dev' || Funcs::config('app.env') == 'local';

	$tablePrefix      = new TablePrefix(Funcs::instance()->_getDBTablePrefix());
	$connectionParams = include __DIR__ . '/config/migrations-db.php';

	$eventManager = new EventManager();
	$eventManager->addEventListener(Events::loadClassMetadata, $tablePrefix);

	$ORMConfig = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode); // PHP 7.4, 8.0

	$connection = DriverManager::getConnection($connectionParams);
	$connection->getConfiguration()->setSchemaAssetsFilter(static function($className) {
		return preg_match('/^' . Funcs::instance()->_getDBTablePrefix() . '((?!cm_cache_items))/iu', $className);
	});

	$entityManager         = new EntityManager($connection, $ORMConfig, $eventManager);
	$existingEntityManager = new ExistingEntityManager($entityManager);

	$dependencyFactory = DependencyFactory::fromEntityManager($config, $existingEntityManager);
	return $dependencyFactory;
}
catch (\Throwable $e) {
	die($e->getMessage());
}