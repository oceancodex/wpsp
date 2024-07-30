<?php

use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\ORMSetup;
use WPSP\Funcs;
use WPSPCORE\Environment\Environment;
use WPSPCORE\Migration\TablePrefix;

/**
 * Environment.
 */
Environment::load(__DIR__ . '/');

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

$ORMConfig = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

$connection = DriverManager::getConnection($connectionParams);
$connection->getConfiguration()->setSchemaAssetsFilter(static function(string $className): bool {
	return preg_match('/^' . Funcs::instance()->_getDBTablePrefix() . '((?!cm_cache_items))/iu', $className);
});

$entityManager         = new EntityManager($connection, $ORMConfig, $eventManager);
$existingEntityManager = new ExistingEntityManager($entityManager);

$dependencyFactory = DependencyFactory::fromEntityManager($config, $existingEntityManager);
return $dependencyFactory;